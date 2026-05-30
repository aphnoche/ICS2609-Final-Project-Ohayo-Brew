<?php
require_once '../../db_ohayo_conn.php';
session_start();

if(isset($_GET['id'])) {
    $_SESSION['product_id'] = $_GET['id'];
}
if(isset($_GET['name'])) {
    $_SESSION['product_name'] = $_GET['name'];
}
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
        <?php
        if(isset($_SESSION['product_id'])) {
            $searchpro = "SELECT * FROM tb_product WHERE product_id = '".$_SESSION['product_id']. "'";
            $res_pro = $conn->query($searchpro);
            $row_pro = $res_pro->fetch_assoc();
            if($row_pro) {
                $_SESSION['product_name'] = $row_pro['product_name'];
            }
        }
        ?>
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
                                        <label class="form-label">Product Name</label>
                                        <input type="text" name = "Product" class="form-control edit-content" value="<?php echo $row_pro['product_name']; ?>">
                                    </div>
                                     <div class="row">
                                        <label  class="form-label">Description</label>
                                        <textarea class="form-control edit-content" name ="Description" rows="3"><?php echo $row_pro['description']; ?></textarea>
                                    </div>
                                    <div class="row">
                                        <label  class="form-label">Price</label>
                                        <input type="number" name = "Price" class="form-control edit-content" value="<?php echo $row_pro['price']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-5">
                                    <div class="col d-flex align-items-center justify-content-center gap-4">
                                            <button type="button" name ="Edit" class = "btn end-button rounded-3 Edit px-4">Edit</button>
                                            <button type="button" name ="Remove" class = "btn end-button rounded-3 Remove font-white">Remove</button>
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

