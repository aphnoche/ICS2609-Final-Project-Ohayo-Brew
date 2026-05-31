<?php
session_start();
require_once 'db_ohayo_conn.php';

// 1. CATCH payload from product.php and append cleanly to Cart Session
if (isset($_POST['product_id'])) {
    $product_id = (int) $_POST['product_id'];
    $temperature = mysqli_real_escape_string($conn, $_POST['temperature'] ?? 'Iced');
    $size = mysqli_real_escape_string($conn, $_POST['size'] ?? 'Regular');
    $quantity = (int) ($_POST['quantity'] ?? 1);
    $notes = mysqli_real_escape_string($conn, $_POST['notes'] ?? '');
    $addons = $_POST['addons'] ?? []; // Array of checked addon IDs

    $_SESSION['cart'][] = [
        'product_id' => $product_id,
        'temperature' => $temperature,
        'size' => $size,
        'quantity' => $quantity,
        'notes' => $notes,
        'addons' => $addons
    ];

    // Redirect to itself via GET to prevent form resubmission on page refreshes
    header("Location: checkout.php");
    exit();
}

// 2. HANDLE single item removal request
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['index'])) {
    $index = (int) $_GET['index'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array elements cleanly
    }
    header("Location: checkout.php");
    exit();
}

// 3. PROCESS structural checkout to the database tables
if (isset($_POST['process_checkout']) && !empty($_SESSION['cart'])) {
    // Automatically reads session user_id if set, otherwise defaults to 1
    $user_id = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : 1;
    $order_date = date('Y-m-d H:i:s');
    $order_status = 'Pending';
    $grand_total = (float) $_POST['grand_total'];

    // Insert Master Entry into tb_order using traditional mysqli_query
    $order_query = "INSERT INTO tb_order (user_id, order_date, total_price, order_status) 
                        VALUES ($user_id, '$order_date', $grand_total, '$order_status')";
    $order_result = mysqli_query($conn, $order_query);

    if ($order_result) {
        // Grab the generated order primary key cleanly
        $order_id = mysqli_insert_id($conn);

        // Loop through cart elements to construct child items
        foreach ($_SESSION['cart'] as $item) {
            $p_id = (int) $item['product_id'];
            $qty = (int) $item['quantity'];
            $item_size = mysqli_real_escape_string($conn, $item['size']);

            // Fetch dynamic exact size price using standard procedural execution
            $size_price_sql = "SELECT price FROM tb_product_size WHERE product_id = $p_id AND LOWER(size_name) = LOWER('$item_size')";
            $size_price_res = mysqli_query($conn, $size_price_sql);

            $base_price = 0;
            if ($size_price_res && mysqli_num_rows($size_price_res) > 0) {
                $size_row = mysqli_fetch_assoc($size_price_res);
                $base_price = (float) $size_row['price'];
            }

            // Aggregate current add-ons prices sums
            $addons_sum = 0;
            if (!empty($item['addons'])) {
                $addon_ids_str = implode(',', array_map('intval', $item['addons']));
                $addons_price_sql = "SELECT SUM(addon_price) AS total_addon_price FROM tb_addon WHERE addon_id IN ($addon_ids_str)";
                $addons_price_res = mysqli_query($conn, $addons_price_sql);

                if ($addons_price_res) {
                    $addon_row = mysqli_fetch_assoc($addons_price_res);
                    $addons_sum = (float) ($addon_row['total_addon_price'] ?? 0);
                }
            }

            $item_price = ($base_price + $addons_sum) * $qty;

            // Insert sub-entry into tb_order_item using standard procedural syntax
            $item_query = "INSERT INTO tb_order_item (order_id, product_id, quantity, item_price) 
                               VALUES ($order_id, $p_id, $qty, $item_price)";
            $item_result = mysqli_query($conn, $item_query);

            if ($item_result) {
                $order_item_id = mysqli_insert_id($conn);

                // Insert applicable child links to your addon junction table
                if (!empty($item['addons'])) {
                    foreach ($item['addons'] as $addon_id) {
                        $a_id = (int) $addon_id;

                        $addon_query = "INSERT INTO tb_order_item_addon (order_item_id, addon_id) 
                                            VALUES ($order_item_id, $a_id)";
                        mysqli_query($conn, $addon_query);
                    }
                }
            }
        }

        unset($_SESSION['cart']); // Wipe session data once written cleanly into DB logs
        header("Location: purchase.php?order_id=" . $order_id); // Route safely to purchase page
        exit();
    } else {
        // Fallback diagnostic output if a foreign key error or structural bug triggers
        echo "Database Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - Ohayo Brew</title>
    <link rel="stylesheet" href="font-family.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background-color: #ffffff;
            color: #2F323A;
            font-family: sans-serif;
        }

        /* NAVBAR ARRANGEMENT (Cart-specific context) */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            margin-right: 50px;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #2b2b2b;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* MAIN TAN CART BACKDROP CANVAS */
        .cart-wrapper {
            max-width: 1200px;
            margin: 30px auto;
            padding: 40px 50px;
            background-color: #ECE6DF;
            /* Exact soft beige color match */
            border-radius: 16px;
        }

        /* HEADER BLOCK WITH BACK BUTTON AND TITLE */
        .cart-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .back-arrow {
            text-decoration: none;
            color: #2F323A;
            font-size: 28px;
            line-height: 1;
            transition: transform 0.2s ease;
        }

        .back-arrow:hover {
            transform: translateX(-4px);
            color: #000000;
        }

        .cart-title {
            font-family: 'New York Large Bold', Georgia, serif;
            font-size: 32px;
            font-weight: bold;
            color: #2F323A;
            margin: 0;
        }

        /* WHITE ITEM CARDS CONTAINER */
        .cart-item-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            gap: 25px;
            align-items: flex-start;
            position: relative;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }

        /* Item Thumbnail Placeholder Block */
        .item-img-box {
            width: 110px;
            height: 110px;
            background-color: #383A42;
            /* Dark charcoal placeholder style */
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .item-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Item Descriptions and Meta details */
        .item-details {
            flex-grow: 1;
        }

        .item-name {
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 19px;
            color: #2F323A;
            margin-bottom: 4px;
            font-weight: 500;
        }

        .item-meta-text {
            font-size: 13px;
            color: #6C727F;
            line-height: 1.4;
            margin-bottom: 0;
        }

        .item-meta-label {
            display: block;
            color: #6C727F;
            margin-top: 2px;
        }

        /* Inner item contextual action row controls */
        .item-actions-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 15px;
            margin-top: auto;
            align-self: flex-end;
        }

        .item-running-total {
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 14px;
            color: #2F323A;
            font-weight: 500;
            margin-right: 10px;
        }

        /* CARD FUNCTIONAL ACTION BUTTON IMPLEMENTATION */
        .btn-item-edit {
            background-color: #2F323A;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 5px 18px;
            font-size: 11px;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .btn-item-edit:hover {
            opacity: 0.9;
        }

        .btn-item-remove {
            background-color: #A37070;
            /* Exact muted rose color from Tea design */
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 5px 18px;
            font-size: 11px;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .btn-item-remove:hover {
            opacity: 0.9;
        }

        /* BOTTOM TOTAL & CHECKOUT SYSTEM */
        .cart-divider {
            border-top: 1px solid #C5BEB7;
            margin-top: 40px;
            margin-bottom: 25px;
        }

        .checkout-summary-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 25px;
        }

        .cart-grand-total {
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 15px;
            color: #2F323A;
            font-weight: 500;
        }

        .btn-checkout-master {
            background-color: #A3734E;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 8px 26px;
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .btn-checkout-master:hover {
            opacity: 0.9;
        }

        .footer-logo-img {
            max-width: 130px;
            height: auto;
            margin-bottom: 12px;
        }
    </style>
</head>

<body>

    <div class="container-navbar">
        <div class="navbar">
            <div class="logo">
                <img src="images/logo.png" alt="Ohayo Brew Logo" style="width: 200px; height: auto; margin-left: 50px;">
            </div>

            <div class="navbar-right">
                <div class="profile-icon">
                    <a href="settings_customer/custoaccount.php"><img src="images/user.png" alt="Profile"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="cart-wrapper">

            <div class="cart-header">
                <a href="javascript:history.back()" class="back-arrow">←</a>
                <h1 class="cart-title">My Cart</h1>
            </div>

            <?php
            $grand_total = 0;
            if (empty($_SESSION['cart'])) {
                ?>
                <div class="text-center py-5 text-muted">Your cart is currently empty.</div>
            <?php
            } else {
                foreach ($_SESSION['cart'] as $index => $item) {
                    $p_id = $item['product_id'];

                    // Pull general product definitions
                    $p_sql = "SELECT product_name, image FROM tb_product WHERE product_id = $p_id";
                    $p_res = $conn->query($p_sql);
                    $product = $p_res->fetch_assoc();

                    // Pull targeted size base cost configuration
                    $size_sql = "SELECT price FROM tb_product_size WHERE product_id = $p_id AND LOWER(size_name) = LOWER('{$item['size']}')";
                    $size_res = $conn->query($size_sql);
                    $base_price = ($size_res->num_rows > 0) ? $size_res->fetch_assoc()['price'] : 0;

                    // Pull active associated options strings
                    $addons_display = [];
                    $addons_sum = 0;
                    if (!empty($item['addons'])) {
                        $addon_ids_str = implode(',', array_map('intval', $item['addons']));
                        $addon_sql = "SELECT addon_name, addon_price FROM tb_addon WHERE addon_id IN ($addon_ids_str)";
                        $addon_res = $conn->query($addon_sql);
                        while ($addon_row = $addon_res->fetch_assoc()) {
                            $addons_display[] = $addon_row['addon_name'] . " (+₱" . number_format($addon_row['addon_price'], 2) . ")";
                            $addons_sum += $addon_row['addon_price'];
                        }
                    }

                    // Perform precise multi-item compound calculation
                    $single_item_base = $base_price + $addons_sum;
                    $item_running_total = $single_item_base * $item['quantity'];
                    $grand_total += $item_running_total;
                    ?>
                    <div class="cart-item-card flex-column flex-md-row">
                        <div class="item-img-box">
                            <?php if (!empty($product['product_image'])) { ?>
                                <img src="images/<?php echo $product['product_image']; ?>"
                                    alt="<?php echo $product['product_name']; ?>">
                            <?php } ?>
                        </div>
                        <div class="item-details">
                            <h2 class="item-name"><?php echo $product['product_name']; ?> (<?php echo $item['temperature']; ?> -
                                <?php echo $item['size']; ?>) x<?php echo $item['quantity']; ?></h2>
                            <p class="item-meta-text">
                                Price: ₱<?php echo number_format($base_price, 2); ?><br>
                                <span class="item-meta-label">Add-ons:</span>
                                <?php echo !empty($addons_display) ? implode(', ', $addons_display) : '-'; ?>
                                <span class="item-meta-label">Note:</span>
                                <?php echo !empty($item['notes']) ? htmlspecialchars($item['notes']) : '-'; ?>
                            </p>
                        </div>
                        <div class="item-actions-row">
                            <div class="item-running-total">Total: ₱<?php echo number_format($item_running_total, 2); ?></div>
                            <a href="product.php?product_id=<?php echo $p_id; ?>"
                                class="btn btn-item-edit text-decoration-none text-center">Edit</a>
                            <a href="checkout.php?action=remove&index=<?php echo $index; ?>"
                                class="btn btn-item-remove text-decoration-none text-center">Remove</a>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="cart-divider"></div>

                <form method="POST" action="checkout.php">
                    <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">
                    <div class="checkout-summary-row">
                        <div class="cart-grand-total">Total: ₱<?php echo number_format($grand_total, 2); ?></div>
                        <button type="submit" name="process_checkout" class="btn-checkout-master">Check Out</button>
                    </div>
                </form>
            <?php } ?>

        </div>
    </div>

    <footer class="text-center py-5 mt-5 border-top bg-white">
        <div class="mb-2">
            <img src="images/logo.png" class="footer-logo-img" alt="OHAYO BREW">
        </div>
        <div class="text-muted small" style="font-size: 11px;">&copy; Ohayo Brew. All Rights Reserved. 2026.</div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>