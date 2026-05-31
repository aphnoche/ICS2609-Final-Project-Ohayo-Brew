<?php
require_once '../../db_ohayo_conn.php';
session_start();

if(isset($_GET['id'])) {
    $_SESSION['product_id'] = $_GET['id'];
}

// 1. Traditional fetch joining tb_product and tb_product_size for the "Regular" price
if(isset($_SESSION['product_id'])) {
    $searchpro = "SELECT p.*, s.price FROM tb_product p 
                  LEFT JOIN tb_product_size s ON p.product_id = s.product_id AND s.size_name = 'Regular' 
                  WHERE p.product_id = '".$_SESSION['product_id']. "'";
    $res_pro = $conn->query($searchpro);
    $row_pro = $res_pro->fetch_assoc();
    if($row_pro) {
        $_SESSION['product_name'] = $row_pro['product_name'];
    }
}

// 2. Traditional Form Handler (Edit / Remove)
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['product_id']) && isset($_POST['action'])) {
    $product_id = $_SESSION['product_id'];

    if($_POST['action'] === 'edit') {

    // I used the mysqli_real_escape_string for the text inputs to prevent errors from special characters 
    // like apostrophes, but I left the price as is since it's a number input and will be validated by HTML5 
        $name = mysqli_real_escape_string($conn, $_POST['Product']);
        $description = mysqli_real_escape_string($conn, $_POST['Description']);
        $price = $_POST['Price'];

        // Handle Image Upload if a file is chosen
        if(isset($_FILES['Product_Image']) && $_FILES['Product_Image']['error'] == 0) {
            $image_path = "images/".$_FILES['Product_Image']['name']; 

            if(move_uploaded_file($_FILES['Product_Image']['tmp_name'], $image_path)) {
                // Traditional Update - saving file name into the 'image' column
                $update_product = "UPDATE tb_product SET product_name = '$name', description = '$description', image = '$image_path' WHERE product_id = '$product_id'";
            }
        } else {
            // Traditional Update without altering the image field if no file chosen
            $update_product = "UPDATE tb_product SET product_name = '$name', description = '$description' WHERE product_id = '$product_id'";
        }

        // Update the Regular price in the product size table
        $update_price = "UPDATE tb_product_size SET price = '$price' WHERE product_id = '$product_id' AND size_name = 'Regular'";

        if($conn->query($update_product) && $conn->query($update_price)) {
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $logsql ="Insert into tb_logs(user_id, action, datetime) 
                values ('".$user_id."', ' Edited a Product', NOW())";
                $conn->query($logsql);
            }
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Product updated successfully!',
                        icon: 'success',
                        confirmButtonColor: '#8B5A2B', // A nice coffee brown color
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'products.php';
                        }
                    });
                });
            </script>";
            exit();
        }

    } elseif($_POST['action'] === 'remove') {
        // Traditional Delete: Clear variations from tb_product_size first to prevent foreign key errors
        $delete_sizes = "DELETE FROM tb_product_size WHERE product_id = '$product_id'";
        $delete_product = "DELETE FROM tb_product WHERE product_id = '$product_id'";
        
        if($conn->query($delete_sizes) && $conn->query($delete_product)) {
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $logsql ="Insert into tb_logs(user_id, action, datetime) 
                values ('".$user_id."', 'Removed a Product', NOW())";
                $conn->query($logsql);
            }
            unset($_SESSION['product_id']);
            unset($_SESSION['product_name']);
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Product removed successfully!',
                            icon: 'success', // or use 'info' if you prefer
                            confirmButtonColor: '#d33', // Red color for deletion confirmation
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'products.php';
                            }
                        });
                    });
                </script>";
            exit();
        }
    }

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
<body class="text-dark">
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
                    <div class="row">
                        <h2 style="font-family: 'New York Large Bold'">Hello, Admin!</h2>
                    </div>
                    <div class="row text-center rounded-4 p-4 my-4" id="orders">
                        <h5><a href="admindash.php" style="font-family: 'New York Large'" class="link-underline link-underline-opacity-0 text-dark">Order List</a></h5>
                    </div>
                    <div class="row text-center p-4 my-4">
                        <h5><a href="products.php" style="font-family: 'New York Large'" class="link-underline link-underline-opacity-0 text-dark">Products List</a></h5>
                    </div>
                    <div class="row text-center p-4 my-4">
                        <h5><a href="logs.php" style="font-family: 'New York Large'" class="link-underline link-underline-opacity-0 text-dark">Logs</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-9">
                <div class="container rounded-4 " id="products-content">
                    <div class="row p-3 products-content-title">
                        <h4>Edit/Remove Product</h4>
                    </div>
                     <div class="row bg-white h-100 w-auto rounded-3 border mx-3 my-2 mb-4 p-5">
                        <form class="container" method="POST" enctype="multipart/form-data">
                            <div class="row mx-auto d-flex align-items-stretch" id="content">
                                <div class="col container d-flex flex-column">
                                    <div class="row border bg-dark p-3 rounded-3 text-center flex-grow-1 d-flex align-items-center justify-content-center" style="min-height: 200px;">
                                        <?php if(!empty($row_pro['image'])): ?>
                                            <span id="placeholderText" class="text-white" style="display: none;">No Image Available</span>
                                            <img id="preview" src="images/<?php echo $row_pro['image']; ?>" alt="Current Image" style="max-height: 180px; width: auto; object-fit: contain;">
                                        <?php else: ?>
                                            <span id="placeholderText" class="text-white">No Image Available</span>
                                            <img id="preview" src="" alt="Preview" style="max-height: 180px; width: auto; object-fit: contain; display: none;">
                                        <?php endif; ?>
                                    </div>
                                     <div class="row text-center">
                                        <p class="mt-2">Change Picture</p>
                                    </div>
                                    <div class="row">
                                        <div class="input-group">
                                            <input type="file" name="Product_Image" class="form-control text-transparent" id="inputGroupFile" onchange="previewImg(event)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col container px-4 pt-3 d-flex flex-column gap-3">
                                    <div class="row">
                                        <label class="form-label">Product Name</label>
                                        <input type="text" name="Product" class="form-control edit-content" value="<?php echo $row_pro['product_name'] ?? ''; ?>">
                                    </div>
                                     <div class="row">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control edit-content" name="Description" rows="3"><?php echo $row_pro['description'] ?? ''; ?></textarea>
                                    </div>
                                    <div class="row">
                                        <label class="form-label">Price</label>
                                        <input type="number" step="0.01" name="Price" class="form-control edit-content" value="<?php echo $row_pro['price'] ?? ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-5">
                                <div class="col d-flex align-items-center justify-content-center gap-4">
                                    <button type="submit" name="action" value="edit" class="btn end-button rounded-3 Edit px-4">Edit</button>
                                    <button type="submit" name="action" value="remove" class="btn end-button rounded-3 Remove font-white" onclick="return confirm('Are you sure you want to delete this product?');">Remove</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        function previewImg(event) {
            var displayImg = document.getElementById('preview');
            displayImg.src = URL.createObjectURL(event.target.files[0]);
            displayImg.style.display = 'block'; // Ensures it displays cleanly if it was hidden

            // Clean-up helper to hide the 'No Image Available' text immediately
            var placeholder = document.getElementById('placeholderText');
            if(placeholder) {
                placeholder.style.display = 'none';
            }
        }
    </script>
</body>
</html>