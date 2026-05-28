<?php
session_start();
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

        .subtitle{
            font-size: 12px;
        }
</style> 
<body class = "text-dark">
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
                    <div class="row">
                        <h2><b>Settings</b></h2>
                    </div>
                     <div class="row text-center p-4 my-3">
                        <h5><a href="customyorder.php" class="link-underline link-underline-opacity-0 text-dark">My Order</a></h5>
                    </div>
                     <div class="row text-center p-4 my-3">
                        <h5><a href="custoaccount.php" class="link-underline link-underline-opacity-0 text-dark">Accounts</a></h5>
                    </div>
                     <div class="row text-center rounded-4 p-4 my-3"  id="orders">
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
                <div class="container rounded-4 " id = "orders-content">
                    <div class="row p-3" id ="orders-content-title">
                        <h4>Customer Information</h4>
                    </div>
                     <div class="row bg-white rounded border mx-3 my-2 px-3 py-3">
                        <div class="container pb-5">
                            <div class="row">
                                <div class="col">
                                    <h5>Name</h5>
                                </div>
                                <div class="col text-end">
                                    <a href="custoinfopt2.php" class="link-underline link-underline-opacity-0 text-dark"><span class="material-symbols-outlined">edit</span></a>
                                </div>
                            </div>
                              <div class="row subtitle">
                                <div class="col">
                                    <p class="text-muted">Address</p>
                                </div>
                            </div>
                             <div class="row subtitle">
                                <div class="col">
                                    <p class=" text-muted">Contact No.</p>
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