<?php
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
</style> 
<body class = "text-dark">
    <!-- Navbar for name -->
    <nav class="navbar navbar-expand-lg navbar-dark d-flexbox">
        <div class="container-fluid">
            <img src="../../images/logo.png" alt="" width = 300 height = 150>

                <div>
                         <img src= ""
                             class="rounded-circle me-2"
                             width="40"
                             height="40">
                </div>

            </div>
        </div>
    </nav>

   <div class="container" id = "menu">
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
                  </div>
            </div>
            <div class="col-9">
                <div class="container rounded-4 " id="products-content">
                    <div class="row p-3 products-content-title">
                        <h4>Products</h4>
                    </div>
                     <div class="row bg-white rounded border mx-3 my-2 px-3 py-2 products-content-title">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <p>Product ID</p>
                                </div>
                                <div class="col text-end">
                                    <p>Price</p>
                                </div>
                            </div>
                              <div class="row">
                                <div class="col">
                                    <p>Product Name</p>
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