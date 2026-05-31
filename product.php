<?php
require_once 'db_ohayo_conn.php';

if (isset($_GET['product_id'])) {
    $product_id = (int) $_GET['product_id'];

    $product_sql = "SELECT * FROM tb_product WHERE product_id = $product_id";
    $product_result = $conn->query($product_sql);

    if ($product_result->num_rows == 1) {
        $product = $product_result->fetch_assoc();
    } else {
        header("Location: home.php");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['product_name']; ?> - Ohayo Brew</title>
    <link rel="stylesheet" href="font-family.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
        body {
            background-color: #ffffff;
            color: #333333;
            font-family: sans-serif;
        }

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

        .back-button {
            display: inline-block;
            margin-left: 50px;
            margin-top: 5px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #333333;
            font-size: 28px;
            transition: transform 0.2s ease;
        }

        .back-button:hover {
            transform: translateX(-5px);
            color: #000000;
        }

        .product-container {
            padding: 0 85px;
        }

        .product-image-box {
            width: 100%;
            height: 520px;
            background-color: #383A42;
            border-radius: 12px;
            overflow: hidden;
        }

        .product-image-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-title-detail {
            font-family: 'New York Large Bold', Georgia, serif;
            font-size: 38px;
            color: #2B323A;
            margin-bottom: 2px;
        }

        .product-description {
            font-size: 15px;
            color: #8E9095;
            margin-bottom: 25px;
        }

        .product-price-detail {
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 26px;
            font-weight: bold;
            color: #2B323A;
            margin-bottom: 25px;
        }

        .temperature-toggle,
        .size-toggle {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
        }

        .option-description {
            font-size: 15px;
            color: #8E9095;
        }

        .btn-temp {
            padding: 6px 20px;
            border-radius: 8px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-temp-outline {
            border: 1px solid #A0A5B0;
            background-color: transparent;
            color: #333333;
        }

        .btn-temp-solid {
            background-color: #2F323A;
            color: #ffffff;
            border: 1px solid #2F323A;
        }

        .quantity-controller {
            display: flex;
            align-items: center;
            margin-bottom: 35px;
        }

        .qty-btn {
            background-color: #2F323A;
            color: #ffffff;
            border: none;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            user-select: none;
        }

        .qty-btn-minus {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
        }

        .qty-btn-plus {
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
        }

        .qty-input {
            width: 50px;
            height: 32px;
            text-align: center;
            border-top: 1px solid #A0A5B0;
            border-bottom: 1px solid #A0A5B0;
            border-left: none;
            border-right: none;
            font-size: 14px;
            color: #2F323A;
            font-weight: bold;
        }

        .section-label {
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 18px;
            color: #8E9095;
            margin-bottom: 12px;
        }

        .addons-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 30px;
        }

        .addon-capsule {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #A0A5B0;
            border-radius: 8px;
            padding: 8px 14px;
            min-width: 160px;
            font-size: 13px;
            color: #333333;
            cursor: pointer;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }

        .addon-capsule:hover {
            background-color: #f8f9fa;
        }

        .addon-capsule.active {
            background-color: #2F323A;
            color: #ffffff;
            border-color: #2F323A;
        }

        .addon-capsule.active .addon-plus-sign {
            color: #ffffff;
        }

        .addon-plus-sign {
            color: #8E9095;
            font-size: 14px;
            margin-left: 10px;
        }

        .notes-textarea {
            width: 100%;
            height: 110px;
            border: 1px solid #A0A5B0;
            border-radius: 8px;
            padding: 12px;
            font-size: 14px;
            resize: none;
            margin-bottom: 35px;
            outline: none;
        }

        .action-buttons-group {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-bottom: 20px;
        }

        .btn-action-cart {
            background-color: #ffffff;
            color: #2F323A;
            border: 1px solid #2F323A;
            border-radius: 8px;
            padding: 10px 30px;
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-action-cart:hover {
            background-color: #f1f2f4;
        }

        .btn-action-buy {
            background-color: #2F323A;
            color: #ffffff;
            border: 1px solid #2F323A;
            border-radius: 8px;
            padding: 10px 35px;
            font-family: 'New York Medium Regular', Georgia, serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .btn-action-buy:hover {
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

    <a href="home.php" class="back-button">←</a>

    <div class="container-fluid product-container">
        <div class="row g-5">

            <div class="col-12 col-md-5">
                <div class="product-image-box">
                    <?php if (!empty($product['image'])) { ?>
                        
                        <img src="dashboards/admin/<?php echo $product['image']; ?>"
                            alt="<?php echo $product['product_name']; ?>">
                            
                    <?php } else { ?>
                        <div class="d-flex h-100 justify-content-center align-items-center text-white-50">No Image Available
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-12 col-md-7">
                <form id="orderForm" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="hidden" name="temperature" id="input_temperature" value="Iced">
                    <input type="hidden" name="size" id="input_size" value="Regular">
                    <input type="hidden" name="quantity" id="input_quantity" value="1">

                    <h1 class="product-title-detail"><?php echo $product['product_name']; ?></h1>
                    <p class="product-description"><?php echo $product['description']; ?></p>

                    <div class="product-price-detail">₱<span id="display-total-price">0.00</span></div>

                    <div class="row">
                        <div class="col-3 option-description">
                            <p class="product-description">Temperature:</p>
                        </div>
                        <div class="col-3 option-description">
                            <p class="product-description">Size:</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 temperature-toggle">
                            <button type="button" class="btn-temp btn-temp-outline" data-temp="Hot">Hot</button>
                            <button type="button" class="btn-temp btn-temp-solid" data-temp="Iced">Iced</button>
                        </div>

                        <div class="col-3 size-toggle">
                            <?php
                            $reg_price = 0;
                            $large_price = 0;
                            $size_sql = "SELECT size_name, price FROM tb_product_size WHERE product_id = $product_id";
                            $size_result = mysqli_query($conn, $size_sql);
                            while ($row = mysqli_fetch_assoc($size_result)) {
                                if (strtolower($row['size_name']) == 'regular')
                                    $reg_price = $row['price'];
                                if (strtolower($row['size_name']) == 'large')
                                    $large_price = $row['price'];
                            }
                            ?>
                            <button type="button" class="btn-temp btn-temp-solid" data-size="Regular"
                                data-price="<?php echo $reg_price; ?>">Regular</button>
                            <button type="button" class="btn-temp btn-temp-outline" data-size="Large"
                                data-price="<?php echo $large_price; ?>">Large</button>
                        </div>
                    </div>

                    <div class="quantity-controller">
                        <button type="button" class="qty-btn qty-btn-minus">-</button>
                        <input type="text" class="qty-input" value="1" readonly>
                        <button type="button" class="qty-btn qty-btn-plus">+</button>
                    </div>

                    <div class="section-label">Add-ons:</div>
                    <div class="addons-grid">
                        <?php
                        $addon_sql = "SELECT * FROM tb_addon";
                        $addon_result = mysqli_query($conn, $addon_sql);
                        while ($addon = mysqli_fetch_assoc($addon_result)) {
                            ?>
                            <label class="addon-capsule" style="cursor: pointer;">
                                <input type="checkbox" name="addons[]" value="<?php echo $addon['addon_id']; ?>"
                                    data-price="<?php echo $addon['addon_price']; ?>" class="addon-checkbox"
                                    style="display:none;">
                                <span><?php echo $addon['addon_name']; ?>
                                    (P<?php echo number_format($addon['addon_price'], 2); ?>)</span>
                                <span class="addon-plus-sign">+</span>
                            </label>
                        <?php } ?>
                    </div>

                    <div class="section-label">Notes:</div>
                    <textarea class="notes-textarea" name="notes"
                        placeholder="Any specifications? (e.g., less sweet, more ice)"></textarea>

                    <div class="action-buttons-group">
                        <button type="button" id="btnAddToCart" class="btn-action-cart">Add to Cart</button>
                        <button type="button" id="btnBuyNow" class="btn-action-buy">Buy Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="text-center py-5 mt-5 border-top bg-white">
        <div class="mb-2">
            <img src="images/logo.png" class="footer-logo-img" alt="OHAYO BREW">
        </div>
        <div class="text-muted small" style="font-size: 11px;">&copy; Ohayo Brew. All Rights Reserved. 2026.</div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('orderForm');
            const displayPrice = document.getElementById('display-total-price');
            const tempButtons = document.querySelectorAll('[data-temp]');
            const sizeButtons = document.querySelectorAll('[data-size]');
            const addonCheckboxes = document.querySelectorAll('.addon-checkbox');
            const minusBtn = document.querySelector('.qty-btn-minus');
            const plusBtn = document.querySelector('.qty-btn-plus');
            const qtyInput = document.querySelector('.qty-input');

            const inputTemp = document.getElementById('input_temperature');
            const inputSize = document.getElementById('input_size');
            const inputQty = document.getElementById('input_quantity');

            // Pristine Mathematics Re-tally Engine
            function calculateTotal() {
                // 1. Get Base Price directly from the currently active selected size button
                const activeSizeBtn = document.querySelector('[data-size].btn-temp-solid');
                const basePrice = parseFloat(activeSizeBtn.getAttribute('data-price')) || 0;

                // 2. Safely sum up ALL checked native add-on inputs simultaneously
                let addonsTotal = 0;
                document.querySelectorAll('.addon-checkbox:checked').forEach(cb => {
                    addonsTotal += parseFloat(cb.getAttribute('data-price')) || 0;
                });

                // 3. Apply operational unit multiplier logic calculations
                const quantity = parseInt(qtyInput.value) || 1;
                const finalTotal = (basePrice + addonsTotal) * quantity;

                // 4. Update display element output on screen
                displayPrice.innerText = finalTotal.toFixed(2);
            }

            // Temperature Controller Actions
            tempButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    tempButtons.forEach(b => b.classList.replace('btn-temp-solid', 'btn-temp-outline'));
                    this.classList.replace('btn-temp-outline', 'btn-temp-solid');
                    inputTemp.value = this.getAttribute('data-temp');
                });
            });

            // Dynamic Size Swapping Actions (Updates base configuration instantly)
            sizeButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    sizeButtons.forEach(b => b.classList.replace('btn-temp-solid', 'btn-temp-outline'));
                    this.classList.replace('btn-temp-outline', 'btn-temp-solid');

                    inputSize.value = this.getAttribute('data-size');
                    calculateTotal(); // Triggers math recalculation with fresh base numbers
                });
            });

            // True Input Change Handler (Guarantees clean styling states and reliable addition/subtraction)
            addonCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const capsule = this.closest('.addon-capsule');
                    const plusSign = capsule.querySelector('.addon-plus-sign');

                    if (this.checked) {
                        capsule.classList.add('active');
                        plusSign.innerText = '✓';
                    } else {
                        capsule.classList.remove('active');
                        plusSign.innerText = '+';
                    }

                    calculateTotal(); // Recalculate using absolute active elements state
                });
            });

            // Unit Multiplier Actions
            minusBtn.addEventListener('click', function () {
                let currentVal = parseInt(qtyInput.value) || 1;
                if (currentVal > 1) {
                    qtyInput.value = currentVal - 1;
                    inputQty.value = qtyInput.value;
                    calculateTotal();
                }
            });

            plusBtn.addEventListener('click', function () {
                let currentVal = parseInt(qtyInput.value) || 1;
                qtyInput.value = currentVal + 1;
                inputQty.value = qtyInput.value;
                calculateTotal();
            });

            // Form Target Router Buttons
            document.getElementById('btnAddToCart').addEventListener('click', function () {
                form.action = 'checkout.php';
                form.submit();
            });

            document.getElementById('btnBuyNow').addEventListener('click', function () {
                form.action = 'purchase.php';
                form.submit();
            });

            // Set Initial Layout Defaults On Page Load
            calculateTotal();
        });
    </script>
</body>

</html>