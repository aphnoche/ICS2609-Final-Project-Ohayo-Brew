<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Customer Information</title>
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
            margin-bottom: 20px;
        }

        .btn-add-info {
            background-color: #a07840;
            color: #ffffff;
            border-radius: 24px;
            font-size: 15px;
            padding: 10px 22px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: Georgia, 'Times New Roman', serif;
        }

        .btn-add-info:hover {
            background-color: #8b6530;
            color: #ffffff;
        }

        .edit-card {
            background-color: #ffffff;
            border-radius: 14px;
            padding: 28px 32px 32px 32px;
        }

        .edit-card-heading {
            font-size: 17px;
            font-weight: 600;
            color: #2b2b2b;
            margin-bottom: 22px;
        }

        .form-control-custom {
            background-color: #ffffff;
            border: 1.5px solid #c8c0b4;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 15px;
            color: #2b2b2b;
            font-family: Georgia, 'Times New Roman', serif;
            width: 100%;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control-custom::placeholder {
            color: #9e9488;
        }

        .form-control-custom:focus {
            border-color: #a07840;
            box-shadow: none;
        }

        .btn-apply {
            background-color: #a07840;
            color: #ffffff;
            border-radius: 24px;
            font-size: 15px;
            padding: 11px 32px;
            border: none;
            font-family: Georgia, 'Times New Roman', serif;
            margin-top: 10px;
        }

        .btn-apply:hover {
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
            <div class="col">
                <div class="content-panel">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="section-heading mb-0">Customer Information</div>
                        <button class="btn-add-info">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="8" x2="12" y2="16"/>
                                <line x1="8" y1="12" x2="16" y2="12"/>
                            </svg>
                            Add Information
                        </button>
                    </div>

                    <div class="edit-card">
                        <div class="edit-card-heading">Edit Information</div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control-custom" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control-custom" placeholder="Last Name">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control-custom" placeholder="Address">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control-custom" placeholder="Contact Number">
                            </div>
                            <div class="col-12">
                                <input type="email" class="form-control-custom" placeholder="Email Address">
                            </div>
                            <div class="col-12 d-flex justify-content-center mt-2">
                                <button class="btn-apply">Apply Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
