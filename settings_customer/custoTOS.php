<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Order List</title>
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

        .greeting {
            font-size: 34px;
            font-style: italic;
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
            font-size: 21px;
            font-weight: 700;
            color: #2b2b2b;
            margin-bottom: 16px;
        }

        .order-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 16px;
        }

        .tos-section {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .order-detail {
            font-size: 13px;
            color: #2b2b2b;
        }

        .btn-dark-custom {
            background-color: #2b2b3b;
            color: #ffffff;
            border-radius: 20px;
            font-size: 13px;
            padding: 7px 18px;
            border: none;
        }

        .btn-gold-custom {
            background-color: #a07840;
            color: #ffffff;
            border-radius: 20px;
            font-size: 13px;
            padding: 7px 18px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="header-bar d-flex justify-content-between align-items-center">
        <div>
            <img src="../../images/logo.png" alt="" class="logo-img">
        </div>
        <div class="profile-icon">
            <img src="" alt="">
        </div>
    </div>
    <div class="container-fluid px-4 py-3">
        <div class="row">
            <div class="col-3 col-xl-2 pe-4">
                <div class="greeting">Hello, admin!</div>
                <div class="nav-item-link">My Order</div>
                <div class="nav-item-link">Accounts</div>
                <div class="nav-item-link">Customer Information</div>
                <div class="nav-item-link">Payment Method</div>
                <div class="nav-item-link">Terms of Service</div>
            </div>
            <div class="col-9 col-xl-10">
                <div class="content-panel">
                    <div class="row">
                        <div class="col">
                            <div class="section-heading">Terms of Service</div>
                            <div class="order-card">
                                <div class="tos-section">
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi eveniet quo possimus error voluptas iste, distinctio debitis harum sit incidunt expedita vero, illo non ducimus perferendis esse reprehenderit officia. Aliquid.
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi eveniet quo possimus error voluptas iste, distinctio debitis harum sit incidunt expedita vero, illo non ducimus perferendis esse reprehenderit officia. Aliquid.                                    
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi eveniet quo possimus error voluptas iste, distinctio debitis harum sit incidunt expedita vero, illo non ducimus perferendis esse reprehenderit officia. Aliquid.                                    
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi eveniet quo possimus error voluptas iste, distinctio debitis harum sit incidunt expedita vero, illo non ducimus perferendis esse reprehenderit officia. Aliquid.                                    
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi eveniet quo possimus error voluptas iste, distinctio debitis harum sit incidunt expedita vero, illo non ducimus perferendis esse reprehenderit officia. Aliquid.                                    
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
