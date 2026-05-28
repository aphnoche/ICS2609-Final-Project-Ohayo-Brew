<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Customer Information</title>
    <link rel="stylesheet" href="../font-family.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: "New York Medium Regular";

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
            border-radius: 10px;
        }

        .section-heading {
            font-size: 40px;
            color: #3a3f4b;
            font-family: "New York Medium Bold";
        }

        .btn-add-info {
            background-color: #a07840;
            color: #ffffff;
            border-radius: 10px;
            font-size: 15px;
            padding: 10px 22px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family:"New York Medium Regular";
            margin-bottom: 20px;
        }

        .btn-add-info:hover {
            background-color: #8b6530;
            color: #ffffff;
        }

        .edit-card {
            background-color: #ffffff;
            border-radius: 14px;
            padding: 28px 32px 40px 50px;
        }

        .edit-card-heading {
            font-size: 17px;
            font-weight: 600;
            color: #2b2b2b;
            margin-bottom: 22px;
        }

        .form{
            width:65%;
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
            border-radius: 10px;
            font-size: 15px;
            padding: 11px 32px;
            border: none;
            font-family: "New York Medium Regular";
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
                     <div class="row text-center p-4 my-3 rounded-4" id="orders">
                        <h5><a href="custoinfo.php" class = "link-underline link-underline-opacity-0 text-dark">Customer Information</a></h5>
                    </div>
                    <div class="row text-center p-4 my-3">
                        <h5><a href="custopayment.php" class = "link-underline link-underline-opacity-0 text-dark">Payment Method</a></h5>
                    </div>
                    <div class="row text-center p-4 my-3">
                        <h5><a href="custoTOS.php" class = "link-underline link-underline-opacity-0 text-dark">Terms of Service</a></h5>
                    </div>

                  </div>
                </div>
            <div class="col-9">
                <div class="container rounded-4" id="orders-content">
                    <div class="row p-3" id="orders-content-title">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h4 class="mb-0">Customer Information</h4>
                            <button class="btn-add-info">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="12" y1="8" x2="12" y2="16"/>
                                    <line x1="8" y1="12" x2="16" y2="12"/>
                                </svg>
                                Add Information
                            </button>
                        </div>
                    </div>
                    <div class="row bg-white rounded border m-4 px-3 py-3">
                        <div class="container pb-5">
                            <div class="row">
                                <div class="col">
                                    <div class="edit-card-heading">Edit Information</div>
                                </div>
                            </div>
                            <div class="row g-3 form mx-auto">
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
                                <div class="col-12 d-flex justify-content-center mt-4">
                                    <button class="btn-apply">Apply Changes</button>
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
