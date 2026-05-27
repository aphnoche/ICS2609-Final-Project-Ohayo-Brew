<?php
    require_once 'db_ohayo_conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Ohayo Brew</title>
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

        /* Group container for keeping checkout and profile items together */
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 60px;         /* Adjust this value to change space between checkout and profile */
            margin-right: 50px; /* Keeps the right side margin consistent with the original design */
        }

        .nav-links {
            display: flex;
            align-items: center;
        }

        .nav-links img {
            width: 30px; /* Set an explicit size for your checkout image if needed */
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

        /* PRODUCT DETAIL PAGE STYLES */
        .back-button {
            display: inline-block;
            margin-left: 50px;
            margin-top: 10px;
            margin-bottom: 20px;
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
            padding: 0 50px;
        }

        /* Dark Charcoal Image Canvas Box */
        .product-image-box {
            width: 100%;
            height: 520px;
            background-color: #383A42; /* Exact color swatch match from mockup */
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

        /* Hot & Iced Segmented Toggles */
        .temperature-toggle {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
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

        /* Quantity Counter Incrementer Block */
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

        /* Add-ons List Section */
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
            transition: background-color 0.2s ease;
        }
        .addon-capsule:hover {
            background-color: #f8f9fa;
        }
        .addon-plus-sign {
            color: #8E9095;
            font-size: 14px;
            margin-left: 10px;
        }

        /* Textarea Notes Frame */
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

        /* Bottom Action Buttons alignment layout */
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
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }
        .btn-action-buy:hover {
            opacity: 0.9;
        }

        /* Footer Logo Image Formatting */
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

    <a href="javascript:history.back()" class="back-button">←</a>

    <div class="container-fluid product-container">
        <div class="row g-5">
            
            <div class="col-12 col-md-5">
                <div class="product-image-box">
                    <img src="" alt=""> 
                </div>
            </div>

            <div class="col-12 col-md-7">
                
                <h1 class="product-title-detail">Product Name</h1>
                <p class="product-description">Lorem Ipsum Description</p>
                
                <div class="product-price-detail">P120.00</div>

                <div class="temperature-toggle">
                    <button type="button" class="btn-temp btn-temp-outline">Hot</button>
                    <button type="button" class="btn-temp btn-temp-solid">Iced</button>
                </div>

                <div class="quantity-controller">
                    <button type="button" class="qty-btn qty-btn-minus">-</button>
                    <input type="text" class="qty-input" value="1" readonly>
                    <button type="button" class="qty-btn qty-btn-plus">+</button>
                </div>

                <div class="section-label">Add-ons:</div>
                <div class="addons-grid">
                    <div class="addon-capsule">
                        <span>Oat Milk (P30.00)</span>
                        <span class="addon-plus-sign">+</span>
                    </div>
                    <div class="addon-capsule">
                        <span>Espresso Shot (P25.00)</span>
                        <span class="addon-plus-sign">+</span>
                    </div>
                    <div class="addon-capsule">
                        <span>Syrup (P25.00)</span>
                        <span class="addon-plus-sign">+</span>
                    </div>
                    <div class="addon-capsule">
                        <span>Whipped Cream (P20.00)</span>
                        <span class="addon-plus-sign">+</span>
                    </div>
                </div>

                <div class="section-label">Notes:</div>
                <textarea class="notes-textarea" placeholder=""></textarea>

                <div class="action-buttons-group">
                    <button type="button" class="btn-action-cart">Add to Cart</button>
                    <button type="button" class="btn-action-buy">Buy Now</button>
                </div>

            </div>

        </div>
    </div>

    <footer class="text-center py-5 mt-5 border-top bg-white">
        <div class="mb-2">
            <img src="images/logo.png" class="footer-logo-img" alt="OHAYO BREW">
        </div>
        <div class="text-muted small" style="font-size: 11px;">Copyright Infringement. All Rights Reserved. 2026.</div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>