<?php
session_start();
require_once '../db_ohayo_conn.php';

// Get the user ID from the session (default to 1 for testing)
$user_id = $_SESSION['user_id'] ?? 1;

// 1. Query for First Name and Last Name
$selectname_sql = "SELECT first_name, last_name FROM tb_user WHERE user_id = $user_id";
$name_result = mysqli_query($conn, $selectname_sql);
$name_row = mysqli_fetch_assoc($name_result);
$first_name = $name_row['first_name'];
$last_name = $name_row['last_name'];

// 2. Query for Address
$selectaddress_sql = "SELECT address FROM tb_user WHERE user_id = $user_id";
$address_result = mysqli_query($conn, $selectaddress_sql);
$address_row = mysqli_fetch_assoc($address_result);
$address = $address_row['address'];

// 3. Query for Contact Number
$selectcontactno_sql = "SELECT contact_no FROM tb_user WHERE user_id = $user_id";
$contactno_result = mysqli_query($conn, $selectcontactno_sql);
$contactno_row = mysqli_fetch_assoc($contactno_result);
$contact_no = $contactno_row['contact_no'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Settings</title>
    <link rel="stylesheet" href="../font-family.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=edit" />
</head>
<style>
    img{
        object-fit:cover;
    }
    body{
        font-family: "New York Medium Regular";
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
    .header-bar {
        background-color: #ffffff;
        padding: 16px 40px;
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

    .big-username {
        font-family: "New York Large Bold";
        font-size: 24px;
        margin-bottom: 20px;
    }

    .subtitle{
        font-size: 15px;
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
    .sticky-top{
        top: 60px;
    }
</style> 
<body class="text-dark">
   <div class="header-bar d-flex justify-content-between align-items-center">
      <div>
            <img src="../images/logo.png" alt="" class="logo-img">
        </div>
        <div class="profile-icon">
            <img src="../images/user.png" alt="Profile">
        </div>
   </div>

    <div class="container">
        <div class="row">
            <div class="col">
                  <div class="container sticky-top">
                    <div class="row">
                        <h2><b>Settings</b></h2>
                    </div>
                     <div class="row text-center p-4 my-3">
                        <h5><a href="customyorder.php" class="link-underline link-underline-opacity-0 text-dark">My Order</a></h5>
                    </div>
                     <div class="row text-center p-4 my-3">
                        <h5><a href="custoaccount.php" class="link-underline link-underline-opacity-0 text-dark">Accounts</a></h5>
                    </div>
                     <div class="row text-center rounded-4 p-4 my-3" id="orders">
                        <h5><a href="custoinfo.php" class="link-underline link-underline-opacity-0 text-dark">Customer Information</a></h5>
                    </div>
                    <div class="row text-center p-4 my-3">
                        <h5><a href="custopayment.php" class="link-underline link-underline-opacity-0 text-dark">Payment Method</a></h5>
                    </div>
                    <div class="row text-center p-4 my-3">
                        <h5><a href="custoTOS.php" class="link-underline link-underline-opacity-0 text-dark">Terms of Service</a></h5>
                    </div>
                  </div>
            </div>
            
            <div class="col-9">
                <div class="container fixed rounded-4 overflow-auto" id="orders-content">
                    <div class="row pt-4 px-4" id="orders-content-title">
                        <div class="col-9">
                            <h1>Customer Information</h1>
                        </div>
                        <div class="col pt-3 text-end">
                        </div>
                    </div>
                     <div class="row bg-white rounded border mx-5 mb-3 px-3 py-3">
                        <div class="container pb-4">
                            <div class="row">
                                <div class="col">
                                    <h5 class="big-username"><?php echo $first_name; ?> <?php echo $last_name; ?></h5>
                                </div>
                                <div class="col text-end">
                                    <a href="custoinfoedit.php" class="link-underline link-underline-opacity-0 text-dark">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="row subtitle">
                                <div class="col">
                                    <p class="text-muted"><?php echo $address; ?></p>
                                </div>
                            </div>
                            
                            <div class="row subtitle">
                                <div class="col">
                                    <p class="text-muted"><?php echo $contact_no; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>