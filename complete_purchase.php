<?php
    require_once 'db_ohayo_conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - Ohayo Brew</title>
    <link rel="stylesheet" href="font-family.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <style>
        body {
            background-color: #ffffff;
            color: #2F323A;
            font-family: sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        /* MAIN LANDING SUCCESS CONTENT HOUSING */
        .success-content-wrapper {
            max-width: 850px;
            margin: auto auto auto 10%; /* Creates the elegant, left-heavy padding style */
            padding: 20px;
        }

        .success-title {
            font-family: 'New York Large Bold', Georgia, serif;
            font-size: 64px;
            font-weight: bold;
            color: #2F323A;
            margin-bottom: 25px;
            letter-spacing: -0.5px;
        }

        .success-subtext {
            font-size: 15px;
            color: #2F323A;
            line-height: 1.6;
            margin-bottom: 45px;
        }

        /* INTERACTION CONTROL PANEL ROW */
        .action-button-row {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        /* Outline layout style button */
        .btn-back-home {
            background-color: #ffffff;
            color: #2F323A;
            border: 1px solid #A2A4A8; /* Thin subtle grey boundary line */
            border-radius: 8px;
            padding: 10px 32px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }
        .btn-back-home:hover {
            border-color: #2F323A;
            background-color: #f9f9f9;
            color: #2F323A;
        }

        /* Filled charcoal block button style */
        .btn-track-order {
            background-color: #383A42; /* Premium dark charcoal slate tint */
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 11px 32px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: opacity 0.2s ease;
        }
        .btn-track-order:hover {
            opacity: 0.9;
            color: #ffffff;
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
                    <a href="cart.php"><img src="images/checkout.png" alt="Cart"></a>
                </div>
                <div class="profile-icon">
                    <a href="settings_customer/custoaccount.php"><img src="images/user.png" alt="Profile"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="success-content-wrapper">
        <h1 class="success-title">Payment successful.</h1>
        <p class="success-subtext">
            Kindly wait for your order. You may track your order by pressing the “Track My Order” button.
        </p>
        
        <div class="action-button-row">
            <a href="home.php" class="btn-back-home">Back to Home</a>
            <a href="track_order.php" class="btn-track-order">Track My Order</a>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>