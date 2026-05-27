<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Payment Method</title>
    <link rel="stylesheet" href="../font-family.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family:  "New York Medium Regular";
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

        .profile-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


         #orders{
        background-color: #eee8e0;
    }
    #orders-content{
        height: 100%;
        background-color: #eee8e0;
    }
    #orders-content-title{
        font-family: "New York Large Bold";
    }

        .content-panel {
            background-color: #ede8e0;
            border-radius: 16px;
            padding: 30px 34px;
            min-height: 100%;
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
            <img src="../images/logo.png" alt="" width = auto height = 100>
        </div>
        <div class="profile-icon">
            <img src="" alt="">
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row ">
                        <h2><b>Settings</b></h2>
                    </div>
                     <div class="row text-center rounded-4 p-4 my-3">
                        <h5><a href="customyorder.php" class="link-underline link-underline-opacity-0 text-dark">My Order</a></h5>
                    </div>
                     <div class="row text-center p-4 my-3">
                        <h5><a href="custoaccount.php" class="link-underline link-underline-opacity-0 text-dark">Accounts</a></h5>
                    </div>
                     <div class="row text-center p-4 my-3">
                        <h5><a href="custoinfo.php" class = "link-underline link-underline-opacity-0 text-dark">Customer Information</a></h5>
                    </div>
                    <div class="row text-center p-4 my-3 rounded-4" id="orders">
                        <h5><a href="custopayment.php" class = "link-underline link-underline-opacity-0 text-dark">Payment Method</a></h5>
                    </div>
                    <div class="row text-center p-4 my-3">
                        <h5><a href="custoTOS.php" class = "link-underline link-underline-opacity-0 text-dark">Terms of Service</a></h5>
                    </div>
                  </div>
            </div>

            <div class="col-9">
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
