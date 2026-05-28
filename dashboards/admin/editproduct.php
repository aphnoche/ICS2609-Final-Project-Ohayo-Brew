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

    #products{
        background-color: #eee8e0;
    }
    #products-content{
        min-height: 100%;
        background-color: #eee8e0;
    }
    .products-content-title{
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
        .end-button{
            font-size: 12px;
        }
        .Edit{
             background-color: #a7794b;
            color: white;
        }
        .Edit:hover{
             background-color: #a7794b;
            color: white;
        }

        .Remove{
            background-color: #a36a6a;
            color: white;
        }
        .Remove:hover{
            background-color: #a36a6a;
            color: white;
        }
        .Status{
            color: white;
        }
       #content{
            width: 70%;
        }
        textarea{
            resize: none;
        }
        .edit-content{
            border-color: #a7794b;
        }
</style> 
<body class = "text-dark">
    <!-- Navbar for name -->
    <div class="header-bar d-flex justify-content-between align-items-center">
        <div>
            <img src="../../images/logo.png" alt="" class="logo-img">
        </div>
        <div class="profile-icon">
            <img src="../../images/PROFILE SYMBOL.png" alt="">
        </div>
</div>
   <div class="container">
        <div class="row">
            <div class="col">
                  <div class="container">
                    <div class="row ">
                        <h2>Hello, Admin!</h2>
                    </div>
                     <div class="row text-center p-4 my-4" >
                        <h5><a href="admindash.php" class="link-underline link-underline-opacity-0 text-dark">Order List</a></h5>
                    </div>
                     <div class="row text-center rounded-4 p-4 my-4 " id="products">
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
                <div class="container rounded-4 " id="products-content">
                    <div class="row p-3 products-content-title">
                        <h4>Edit/Remove Product</h4>
                    </div>
                     <div class="row bg-white h-100 w-auto rounded-3 border mx-3 my-2 mb-4 p-5">
                        <form class="container">
                            <div class="row mx-auto d-flex align-items-stretch" id = "content">
                                <div class="col container d-flex flex-column">
                                    <div class="row border bg-dark p-5 rounded-3 text-center flex-grow-1 d-flex align-items-center justify-content-center">

                                    </div>
                                     <div class="row text-center">
                                        <p>Change Picture</p>
                                    </div>
                                    <div class="row">
                                    <div class="input-group">
                                    <input type="file" class="form-control text-transparent" id="inputGroupFile">
                                    </div>
                                       
                                    </div>
                                </div>
                                <div class="col container px-4 pt-3 d-flex flex-column gap-3">
                                    <div class="row">
                                        <label  class="form-label">Product Name</label>
                                        <input type="text" class="form-control edit-content">
                                    </div>
                                     <div class="row">
                                        <label  class="form-label">Description</label>
                                        <textarea class="form-control edit-content" rows="3"></textarea>
                                    </div>
                                    <div class="row">
                                        <label  class="form-label">Price</label>
                                        <input type="number" class="form-control edit-content">
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-5">
                                    <div class="col d-flex align-items-center justify-content-center gap-4">
                                            <button type="button" class = "btn end-button rounded-3 Edit px-4">Edit</button>
                                            <button type="button" class = "btn end-button rounded-3 Remove font-white">Remove</button>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>