<?php
require_once '../../db_ohayo_conn.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../font-family.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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


    .navbar {
        display: flex;
        justify-content: space-between; 
        align-items: center;          
        padding: 10px 20px;            
    }
    
    .navbar-right {
        display: flex;
        align-items: center;
        margin-right: 65px; 
    }

    .profile-icon {
        width: 40px;
        height: auto;
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

    .logo-img {
            height: 100px;
            width: auto;
        }
        .btn{
            font-size: 10px;
        }

        .view{
            background-color: #2b2b2b;
            color: white;
        }
        .view:hover{
            background-color: #2b2b2b;
            color: white;
        }

        .complete{
            background-color: #a7794b;
            color: white;
        }
        .complete:hover{
            background-color: #a7794b;
            color: white;
        }


</style> 
<body class = "text-dark">
    <!-- Navbar for name -->
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

    <div class="container border-2">
        <div class="row">
            <div class="col">
                  <div class="container">
                    <div class="row ">
                        <h2>Hello, Admin!</h2>
                    </div>
                     <div class="row text-center rounded-4 p-4 my-4" id="orders">
                        <h5><a href="admindash.php" class="link-underline link-underline-opacity-0 text-dark">Order List</a></h5>
                    </div>
                     <div class="row text-center p-4 my-4 ">
                        <h5><a href="products.php" class="link-underline link-underline-opacity-0 text-dark">Products List</a></h5>
                    </div>
                     <div class="row text-center p-4 my-4 ">
                        <h5><a href="logs.php" class = "link-underline link-underline-opacity-0 text-dark">Logs</a></h5>
                    </div>
                    <div class="row text-center p-4 my-4">
                        <h5>&nbsp</h5>
                    </div>
                    <div class="row text-center p-4 my-4">
                        <h5>&nbsp</h5>
                    </div>
                  </div>
            </div>
            <div class="col-9">
                <div class="container rounded-4 " id = "orders-content">
                    <div class="row">
                        <div class="col container">
                            <div class="row p-3" id ="orders-content-title">
                                  <h4>Pending Orders</h4>
                            </div>
                            <div class="row bg-white rounded-3 border mx-3 my-2 px-3 py-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                            <h5 class="card-title">Customer Name</h5>
                                            <h6 class="card-subtitle mt-1 mb-2 text-muted">&nbsp Order
                                                <br> &nbsp Add-ons:
                                                <br> &nbsp example     
                                                <br> &nbsp Note:
                                                <br> &nbsp - </h6>                
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p>&nbsp</p>
                                    </div>
                                    <div class="col-9 text-end d-flex align-items-center justify-content-end gap-3">
                                        <button type="button" class = "btn rounded-3 view">View Full Order</button>
                                    
                                       <button type="button" class = "btn rounded-3 complete">Complete Order</button>

                                    </div>
                                 </div>
                             </div>
                         </div>
                       </div>
                       <div class="col container">
                            <div class="row p-3" id ="orders-content-title">
                                  <h4>Order History</h4>
                            </div>
                            <div class="row bg-white rounded-3 border mx-3 my-2 px-3 py-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                            <h5 class="card-title">Customer Name</h5>
                                            <h6 class="card-subtitle mt-1 mb-2 text-muted">&nbsp Order
                                                <br> &nbsp Add-ons:
                                                <br> &nbsp example     
                                                <br> &nbsp Note:
                                                <br> &nbsp - </h6>        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p>&nbsp</p>
                                    </div>
                                    <div class="col-9 text-end d-flex align-items-center justify-content-end gap-2">
                                        <button type="button" class = "btn rounded-3 view">View Full Order</button>
                                    </div>
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