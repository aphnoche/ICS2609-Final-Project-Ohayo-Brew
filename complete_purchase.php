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

        /*"Complete Purchase"*/
        .main-content-wrapper {
            max-width: 850px;
            margin: 150px auto auto 10%;
            padding: 20px;
        }

        .main-title {
            font-family: 'New York Large Bold', Georgia, serif;
            font-size: 64px;
            font-weight: bold;
            color: #2F323A;
            margin-bottom: 25px;
            letter-spacing: -0.5px;
        }

        .main-subtext {
            font-size: 15px;
            color: #2F323A;
            line-height: 1.6;
            margin-bottom: 45px;
        }

        /*BUTTONS*/
        .buttons-row {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        /*HOME BUTTON*/
        .btn-back-home {
            background-color: #ffffff;
            color: #2F323A;
            border: 1px solid #A2A4A8;
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

        /*TRACK ORDER BUTTON*/
        .btn-track-order {
            background-color: #383A42;
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
                <div class="profile-icon">
                    <a href="settings_customer/custoaccount.php"><img src="images/user.png" alt="Profile"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-wrapper">
        <h1 class="main-title">Payment successful.</h1>
        <p class="main-subtext">
            Kindly wait for your order. You may track your order by pressing the “Track My Order” button.
        </p>

        <div class="buttons-row">
            <a href="home.php" class="btn-back-home">Back to Home</a>
            <a href="settings_customer/customyorder.php" class="btn-track-order">Track My Order</a>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>