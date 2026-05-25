<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Payment Method</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: Georgia, 'Times New Roman', serif;
        }

        .header-bar {
            background-color: #ffffff;
            padding: 16px 40px;
            border-bottom: none;
        }

        .logo-img {
            height: 100px;
            width: auto;
        }

        .header-icons {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .cart-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-icon svg {
            width: 30px;
            height: 30px;
            stroke: #2b2b2b;
            fill: none;
            stroke-width: 1.8;
        }

        .profile-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 2px solid #2b2b2b;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-icon svg {
            width: 28px;
            height: 28px;
            stroke: #2b2b2b;
            fill: none;
            stroke-width: 1.8;
        }

        .greeting {
            font-size: 40px;
            color: #2b2b2b;
            margin-bottom: 32px;
        }

        .nav-item-link {
            font-size: 17px;
            color: #2b2b2b;
            padding: 16px 20px;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            margin-bottom: 12px;
            text-decoration: none;
            display: block;
        }

        .nav-item-link.active-nav {
            background-color: #ede8e0;
            font-weight: 600;
        }

        .content-panel {
            background-color: #ede8e0;
            border-radius: 16px;
            padding: 30px 34px;
            min-height: 560px;
        }

        .section-heading {
            font-size: 26px;
            font-weight: 700;
            color: #2b2b2b;
            margin-bottom: 24px;
        }

        .payment-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 18px 24px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .payment-card-title {
            font-size: 16px;
            font-weight: 600;
            color: #2b2b2b;
        }

        .payment-card-sub {
            font-size: 13px;
            color: #6b6460;
            margin-top: 3px;
        }

        .btn-default {
            background-color: #2b2b3b;
            color: #ffffff;
            border-radius: 20px;
            font-size: 13px;
            padding: 8px 20px;
            border: none;
            font-family: Georgia, 'Times New Roman', serif;
            cursor: default;
        }

        .btn-unlink {
            background-color: #a07840;
            color: #ffffff;
            border-radius: 20px;
            font-size: 13px;
            padding: 8px 20px;
            border: none;
            font-family: Georgia, 'Times New Roman', serif;
        }

        .btn-unlink:hover {
            background-color: #8b6530;
            color: #ffffff;
        }

        .btn-set-default {
            background-color: #2b2b3b;
            color: #ffffff;
            border-radius: 20px;
            font-size: 13px;
            padding: 8px 20px;
            border: none;
            font-family: Georgia, 'Times New Roman', serif;
        }

        .btn-set-default:hover {
            background-color: #1a1a28;
            color: #ffffff;
        }

        .btn-link-card {
            background-color: #a07840;
            color: #ffffff;
            border-radius: 20px;
            font-size: 13px;
            padding: 8px 20px;
            border: none;
            font-family: Georgia, 'Times New Roman', serif;
        }

        .btn-link-card:hover {
            background-color: #8b6530;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="header-bar d-flex justify-content-between align-items-center">
        <div>
            <img src="../images/logo.png" alt="" class="logo-img">
        </div>
        <div class="profile-icon">
            <img src="" alt="">
        </div>
    </div>

    <div class="container-fluid px-4 py-3">
        <div class="row">
            <div class="col-3 col-xl-2 pe-4">
                <div class="greeting">Settings</div>
                <a href="customyorder.php" class="nav-item-link">My Order</a>
                <a href="custoaccount.php" class="nav-item-link">Accounts</a>
                <a href="custoinfo.php" class="nav-item-link">Customer Information</a>
                <a href="custopayment.php" class="nav-item-link active-nav">Payment Method</a>
                <a href="custoTOS.php" class="nav-item-link">Terms of Service</a>
            </div>

            <div class="col-9 col-xl-10">
                <div class="content-panel">
                    <div class="section-heading">Payment Method</div>

                    <div class="payment-card">
                        <div class="payment-card-title">Cash-On-Delivery</div>
                        <div>
                            <button class="btn-default">Default</button>
                        </div>
                    </div>

                    <div class="payment-card">
                        <div>
                            <div class="payment-card-title">e-Wallet</div>
                            <div class="payment-card-sub">GCash</div>
                            <div class="payment-card-sub">09XX XXX XXXX</div>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn-unlink">Unlink</button>
                            <button class="btn-set-default">Set as Default</button>
                        </div>
                    </div>

                    <div class="payment-card">
                        <div class="payment-card-title">Debit Card/Credit Card</div>
                        <div>
                            <button class="btn-link-card">Link</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
