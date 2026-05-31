<?php
session_start();
require_once 'db_ohayo_conn.php';

if (isset($_POST['product_id']) && !isset($_POST['finalize_purchase'])) {

    $user_id = $_SESSION['user_id'] ?? 1;
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);

    $price_query = "SELECT price FROM tb_product_size WHERE product_id = $product_id AND LOWER(size_name) = LOWER('$size')";
    $price_res = mysqli_query($conn, $price_query);
    $size_row = mysqli_fetch_assoc($price_res);
    $base_price = $size_row['price'] ?? 0;

    $addons_unit_total = 0;
    if (!empty($_POST['addons'])) {
        foreach ($_POST['addons'] as $addon_id) {
            $addon_id = intval($addon_id);
            $addon_q = mysqli_query($conn, "SELECT addon_price FROM tb_addon WHERE addon_id = $addon_id");
            $addon_row = mysqli_fetch_assoc($addon_q);
            $addons_unit_total += $addon_row['addon_price'] ?? 0;
        }
    }

    $single_item_total = ($base_price + $addons_unit_total) * $quantity;

    $insert_order = "INSERT INTO tb_order (user_id, total_price, order_status) VALUES ($user_id, $single_item_total, 'Pending')";
    mysqli_query($conn, $insert_order);
    $new_order_id = mysqli_insert_id($conn);

    $insert_item = "INSERT INTO tb_order_item (order_id, product_id, quantity, item_price) VALUES ($new_order_id, $product_id, $quantity, $single_item_total)";
    mysqli_query($conn, $insert_item);
    $new_item_id = mysqli_insert_id($conn);

    if (!empty($_POST['addons'])) {
        foreach ($_POST['addons'] as $addon_id) {
            $addon_id = intval($addon_id);
            mysqli_query($conn, "INSERT INTO tb_order_item_addon (order_item_id, addon_id) VALUES ($new_item_id, $addon_id)");
        }
    }

    header("Location: purchase.php?order_id=" . $new_order_id);
    exit();
}

if (!isset($_GET['order_id'])) {
    header("Location: home.php");
    exit();
}

$order_id = intval($_GET['order_id']);

$order_sql = "SELECT * FROM tb_order WHERE order_id = $order_id";
$order_result = mysqli_query($conn, $order_sql);
$order_master = mysqli_fetch_assoc($order_result);

$user_id = $order_master['user_id'];
$user_sql = "SELECT first_name, last_name, address, contact_no FROM tb_user WHERE user_id = $user_id";
$user_result = mysqli_query($conn, $user_sql);
$user_row = mysqli_fetch_assoc($user_result);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finalize_purchase'])) {
    $update_sql = "UPDATE tb_order SET order_status = 'Processing' WHERE order_id = $order_id";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>window.location.href='complete_purchase.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out - Ohayo Brew</title>
    <link rel="stylesheet" href="font-family.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
        body {
            background-color: #ffffff;
            color: #2F323A;
            font-family: sans-serif;
        }

        /* NAVBAR FUNCTIONALITY */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 60px;
            margin-right: 50px;
        }

        .nav-links {
            display: flex;
            align-items: center;
        }

        .nav-links img {
            width: 30px;
            height: auto;
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

        /* MAIN TAN CHECKOUT MASTER CANVAS */
        .checkout-wrapper {
            max-width: 1200px;
            margin: 30px auto;
            padding: 40px 50px;
            background-color: #ECE6DF;
            border-radius: 16px;
        }

        /* HEADER PANEL WITH BACK CONTROL */
        .checkout-header {
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

        .checkout-title {
            font-family: 'New York Large Bold', Georgia, serif;
            font-size: 32px;
            font-weight: bold;
            color: #2F323A;
            margin: 0;
        }

        /* WHITE CONTENT DETAIL CARDS */
        .details-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            height: 100%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.01);
        }

        .card-heading {
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 20px;
            color: #2F323A;
            margin-bottom: 25px;
            font-weight: 600;
        }

        /* TYPOGRAPHY METRICS FOR CUSTOMER DETAILS */
        .info-group {
            margin-bottom: 22px;
        }

        .info-label {
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 16px;
            font-weight: 600;
            color: #2F323A;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 13px;
            color: #6C727F;
            line-height: 1.4;
        }

        /* NESTED ORDER ITEM FRAMES */
        .order-item-box {
            border: 1px solid #C5BEB7;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            gap: 20px;
            position: relative;
        }

        .order-img-box {
            width: 85px;
            height: 85px;
            background-color: #383A42;
            border-radius: 6px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .order-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .order-details-text {
            flex-grow: 1;
        }

        .order-item-name {
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 17px;
            color: #2F323A;
            margin-bottom: 4px;
            font-weight: 500;
        }

        .order-meta-info {
            font-size: 11px;
            color: #6C727F;
            line-height: 1.4;
            margin-bottom: 0;
        }

        .order-item-total {
            position: absolute;
            bottom: 15px;
            right: 15px;
            font-size: 11px;
            color: #2F323A;
            font-weight: 500;
        }

        /* BOTTOM TOTALIZATION AND CHECKOUT SUBMIT FOOTER */
        .checkout-divider {
            border-top: 1px solid #C5BEB7;
            margin-top: 40px;
            margin-bottom: 25px;
        }

        .checkout-footer-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-amount-label {
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 15px;
            color: #2F323A;
            font-weight: 500;
        }

        .footer-right-actions {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .grand-total-price {
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 15px;
            color: #2F323A;
            font-weight: 500;
        }

        .btn-purchase-order {
            background-color: #A3734E;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 8px 24px;
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .btn-purchase-order:hover {
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
                <div class="nav-links">
                    <a href="checkout.php"><img src="images/checkout.png" alt="Checkout"></a>
                </div>
                <div class="profile-icon">
                    <a href="settings_customer/custoaccount.php"><img src="images/user.png" alt="Profile"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="checkout-wrapper">

            <div class="checkout-header">
                <a href="javascript:history.back()" class="back-arrow">←</a>
                <h1 class="checkout-title">Check Out</h1>
            </div>

            <div class="row g-4">

                <div class="col-12 col-md-4">
                    <div class="details-card">
                        <h2 class="card-heading">Customer Details</h2>

                        <div class="info-group">
                            <div class="info-label">Name</div>
                            <div class="info-value">
                                <?php echo $user_row['first_name'] . " " . $user_row['last_name']; ?>
                            </div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Address</div>
                            <div class="info-value">
                                <?php echo $user_row['address']; ?>
                            </div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Contact Number</div>
                            <div class="info-value">
                                <?php echo $user_row['contact_no']; ?>
                            </div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Mode of Payment</div>
                            <div class="info-value">GCash (09XX XXX XXXX)</div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8">
                    <div class="details-card">
                        <h2 class="card-heading">Order Details</h2>

                        <?php

                        $item_sql = "SELECT oi.*, p.product_name, p.image 
                                         FROM tb_order_item oi 
                                         JOIN tb_product p ON oi.product_id = p.product_id 
                                         WHERE oi.order_id = $order_id";

                        $items_result = mysqli_query($conn, $item_sql);

                        while ($item = mysqli_fetch_assoc($items_result)) {
                            $order_item_id = $item['order_item_id'];


                            $addon_sql = "SELECT a.addon_name, a.addon_price 
                                            FROM tb_order_item_addon oia 
                                            JOIN tb_addon a ON oia.addon_id = a.addon_id 
                                            WHERE oia.order_item_id = $order_item_id";

                            $addons_result = mysqli_query($conn, $addon_sql);
                            $addons_list = [];

                            while ($addon = mysqli_fetch_assoc($addons_result)) {
                                $addons_list[] = $addon['addon_name'] . " - ₱" . number_format($addon['addon_price'], 2);
                            }
                            ?>
                            <div class="order-item-box">
                                <div class="order-img-box">
                                    <?php if (!empty($item['image'])) { ?>
                                        
                                        <img src="dashboards/admin/<?php echo $item['image']; ?>"
                                            alt="<?php echo $item['product_name']; ?>">
                                            
                                    <?php } ?>
                                </div>
                                <div class="order-details-text">
                                    <h3 class="order-item-name"><?php echo $item['product_name']; ?> <span
                                            class="text-muted small">x<?php echo $item['quantity']; ?></span></h3>
                                    <p class="order-meta-info">
                                        Price: ₱<?php echo number_format($item['item_price'] / $item['quantity'], 2); ?><br>
                                        Add-ons:<br>
                                        <?php
                                        if (!empty($addons_list)) {
                                            foreach ($addons_list as $addon_text) {
                                                echo "• " . $addon_text . "<br>";
                                            }
                                        } else {
                                            echo "-<br>";
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="order-item-total">Total: ₱<?php echo number_format($item['item_price'], 2); ?>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>

            </div>

            <div class="checkout-divider"></div>

            <form method="POST" action="">
                <input type="hidden" name="finalize_purchase" value="1">
                <div class="checkout-footer-row">
                    <div class="total-amount-label">Total Amount</div>
                    <div class="footer-right-actions">
                        <div class="grand-total-price">₱<?php echo number_format($order_master['total_price'], 2); ?>
                        </div>
                        <button type="submit" class="btn-purchase-order">Purchase Order</button>
                    </div>
                </div>
            </form>

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