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
        .btn, #status{
            font-size: 12px;
            font-family: "New York Medium Regular";
        }
        .Edit{
            background-color: #2b2b2b;
            color: white;
        }
        .Edit:hover{
            background-color: #2b2b2b;
            color: white;
        }
        .Status::disabled{
             background-color: #2b2b2b;
        }
        .sticky-top{
            top: 60px;
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
<?php
$show_ac = "SELECT * FROM tb_product";

$res_ac = $conn->query($show_ac);
?>

   <div class="container">
        <div class="row">
            <div class="col">
                  <div class="container sticky-top">
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
                        <div class="row p-3">
                            <h4 class = "products-content-title">Products</h4>
                        </div>
                            <?php
                                if($res_ac -> num_rows > 0){
                                    foreach($res_ac as $fieldname_ac){
                            ?>
                        <div class="row bg-white rounded-3 border mx-3 my-2 px-3 py-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-2 border bg-dark p-5 rounded-3 text-center">
                                    </div>
                                    <div class="col container px-4 pt-3">
                                        <div class="row">
                                            <h5><?php echo ($fieldname_ac['product_name']); ?></h5>
                                        </div>
                                        <div class="row">
                                            <p class="text-muted">Description: <?php echo ($fieldname_ac['description']); ?><br>Price: <?php echo ($fieldname_ac['price']); ?></p>
                                        </div>
                                        <div class="row">
                                            <div class="col d-flex align-items-center justify-content-end gap-4">
                                                <a href="editproduct.php?id=<?php echo $fieldname_ac['product_id']; ?>&name=<?php echo ($fieldname_ac['product_name']); ?>" class="btn rounded-3 Edit">Edit/Remove</a>
                                                <div class = "rounded-3 p-2 bg-success text-white" id = "status">Status</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            } else {
                                echo "<div class='row mx-3 my-2'><div class='col'>No record found</div></div>";
                            }
                        ?>
                </div>
            </div>
        </div>
        
    </div>
  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>