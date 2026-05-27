<?php
    require_once 'db_ohayo_conn.php';
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

        /* NAVBAR ARRANGEMENT */
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
            background-color: #ECE6DF; /* Soft beige matching mockup backdrop */
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
            box-shadow: 0 2px 6px rgba(0,0,0,0.01);
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
            border: 1px solid #C5BEB7; /* Thin gray outline card system */
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
            background-color: #383A42; /* Dark charcoal placeholder style */
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

        /* Running item row total positioned exactly in the box bottom-right */
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
            font-size: 15px;
            color: #2F323A;
            font-weight: 500;
        }
        .btn-purchase-order {
            background-color: #A3734E; /* Exact brown swatch match from mockup button */
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 8px 24px;
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
                            <div class="info-value">Alyssa Pauline Noche</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Address</div>
                            <div class="info-value">Blk. 9 Lot 15 Makisig St. Lakandula Subd. Buhay na Tubig, Balayan, Batangas</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Contact Number</div>
                            <div class="info-value">0921 *** **89</div>
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
                        
                        <div class="order-item-box">
                            <div class="order-img-box">
                                <img src="" alt="">
                            </div>
                            <div class="order-details-text">
                                <h3 class="order-item-name">Product Name</h3>
                                <p class="order-meta-info">
                                    Price: ₱120.00<br>
                                    Add-ons:<br>
                                    Espresso Shot x1 - ₱15.00<br>
                                    Note:<br>
                                    -
                                </p>
                            </div>
                            <div class="order-item-total">Total: ₱135.00</div>
                        </div>

                        <div class="order-item-box">
                            <div class="order-img-box">
                                <img src="" alt="">
                            </div>
                            <div class="order-details-text">
                                <h3 class="order-item-name">Product Name</h3>
                                <p class="order-meta-info">
                                    Price: ₱120.00<br>
                                    Add-ons:<br>
                                    -<br>
                                    Note:<br>
                                    -
                                </p>
                            </div>
                            <div class="order-item-total">Total: ₱120.00</div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="checkout-divider"></div>

            <div class="checkout-footer-row">
                <div class="total-amount-label">Total Amount</div>
                <div class="footer-right-actions">
                    <div class="grand-total-price">₱255.00</div>
                    <button type="button" class="btn-purchase-order">Purchase Order</button>
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