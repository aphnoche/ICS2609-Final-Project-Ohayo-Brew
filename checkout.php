<?php
    require_once 'db_ohayo_conn.php';
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
            background-color: #ECE6DF; /* Exact soft beige color match */
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
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        /* Item Thumbnail Placeholder Block */
        .item-img-box {
            width: 110px;
            height: 110px;
            background-color: #383A42; /* Dark charcoal placeholder style */
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
            background-color: #A37070; /* Exact muted rose color from Tea design */
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
            font-size: 15px;
            color: #2F323A;
            font-weight: 500;
        }
        .btn-checkout-master {
            background-color: #A3734E; /* Exact warm brown color match */
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 8px 26px;
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

            <div class="cart-item-card flex-column flex-md-row">
                <div class="item-img-box">
                    <img src="" alt="">
                </div>
                <div class="item-details">
                    <h2 class="item-name">Product Name</h2>
                    <p class="item-meta-text">
                        Price: ₱120.00<br>
                        <span class="item-meta-label">Add-ons:</span>
                        -
                        <span class="item-meta-label">Note:</span>
                        -
                    </p>
                </div>
                <div class="item-actions-row">
                    <div class="item-running-total">Total: ₱120.00</div>
                    <button type="button" class="btn-item-edit">Edit</button>
                    <button type="button" class="btn-item-remove">Remove</button>
                </div>
            </div>

            <div class="cart-item-card flex-column flex-md-row">
                <div class="item-img-box">
                    <img src="" alt="">
                </div>
                <div class="item-details">
                    <h2 class="item-name">Product Name</h2>
                    <p class="item-meta-text">
                        Price: ₱120.00<br>
                        <span class="item-meta-label">Add-ons:</span>
                        Espresso Shot x1 - ₱15.00
                        <span class="item-meta-label">Note:</span>
                        -
                    </p>
                </div>
                <div class="item-actions-row">
                    <div class="item-running-total">Total: ₱135.00</div>
                    <button type="button" class="btn-item-edit">Edit</button>
                    <button type="button" class="btn-item-remove">Remove</button>
                </div>
            </div>

            <div class="cart-divider"></div>

            <div class="checkout-summary-row">
                <div class="cart-grand-total">Total: ₱255.00</div>
                <button type="button" class="btn-checkout-master">Check Out</button>
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