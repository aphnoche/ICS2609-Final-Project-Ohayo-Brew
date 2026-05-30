<?php
require_once '../../db_ohayo_conn.php';
session_start();

// 1. HANDLE STATUS UPDATE (When "Complete Order" button is clicked)
if (isset($_POST['complete_order'])) {
    $order_id = $_POST['order_id'];
    
    // Classic SQL update string
    $update_sql = "UPDATE tb_order SET order_status = 'Completed' WHERE order_id = '$order_id'";
    mysqli_query($conn, $update_sql);
    
    // Refresh page to show the item moved to the other column
    header("Location: admindash.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
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

    /* Scrollview styles for the order panels */
    .order-scrollbox {
        max-height: 400px; /* Fixes the box size */
        overflow-y: auto;   /* Automatically creates vertical scrollbar if needed */
        overflow-x: hidden; /* Prevents awkward side-scrolling */
        padding-bottom: 15px;
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

    .btn{
        font-size: 10px;
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
<body class="text-dark">
    <div class="container-navbar">
        <div class="navbar">
            <div class="logo">
                <img src="../../images/logo.png" alt="Ohayo Brew Logo" style="width: 200px; height: auto; margin-left: 50px;">
            </div>
            <div class="navbar-right">
                <div class="profile-icon">
                    <a href="logout.php"><img src="../../images/user.png" alt="Profile"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container border-2">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <h2 style="font-family: 'New York Large Bold'">Hello, Employee!</h2>
                    </div>
                    <div class="row text-center rounded-4 p-4 my-4" id="orders">
                        <h5><a href="admindash.php" style="font-family: 'New York Large'" class="link-underline link-underline-opacity-0 text-dark">Order List</a></h5>
                    </div>
                    <div class="row text-center p-4 my-4">
                        <h5><a href="products.php" style="font-family: 'New York Large'" class="link-underline link-underline-opacity-0 text-dark">Product Availability</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-9">
                <div class="container rounded-4 py-3" id="orders-content">
                    <div class="row">
                        
                        <div class="col container">
                            <div class="row p-3" id="orders-content-title">
                                <h4>Pending Orders</h4>
                            </div>
                            
                            <div class="order-scrollbox">
                                <?php
                                // Fetch all Pending orders
                                $pending_sql = "SELECT * FROM tb_order WHERE order_status = 'Pending' ORDER BY order_date DESC";
                                $pending_result = mysqli_query($conn, $pending_sql);

                                if (mysqli_num_rows($pending_result) == 0) {
                                    echo "<p class='text-muted ps-3'>No pending orders found.</p>";
                                } else {
                                    // Loop through each order
                                    while ($order = mysqli_fetch_assoc($pending_result)) {
                                        $current_order_id = $order['order_id'];
                                ?>
                                        <div class="row bg-white rounded-3 border mx-3 my-2 px-3 py-2">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title">Customer ID: <?php echo $order['user_id']; ?></h5>
                                                        <h6 class="card-subtitle mt-1 mb-2 text-muted">
                                                            Order ID: #<?php echo $order['order_id']; ?><br>
                                                            Date: <?php echo $order['order_date']; ?><br>
                                                            Total: ₱<?php echo number_format($order['total_price'], 2); ?>
                                                            <hr class="my-1">
                                                            <strong>Items Ordered:</strong>
                                                            
                                                            <?php
                                                            // Fetch items for this specific order
                                                            $item_sql = "SELECT * FROM tb_order_item WHERE order_id = '$current_order_id'";
                                                            $item_result = mysqli_query($conn, $item_sql);
                                                            
                                                            // Loop through the items
                                                            while ($item = mysqli_fetch_assoc($item_result)) {
                                                                $current_item_id = $item['order_item_id'];
                                                                $p_id = $item['product_id'];

                                                                // Fetch product name using standard lookup query method
                                                                $p_name_sql = "SELECT product_name FROM tb_product WHERE product_id = '$p_id'";
                                                                $p_name_result = mysqli_query($conn, $p_name_sql);
                                                                $p_row = mysqli_fetch_assoc($p_name_result);
                                                                $product_name = $p_row ? $p_row['product_name'] : "Unknown Item";
                                                            ?>
                                                                <br> • <?php echo $product_name; ?> (x<?php echo $item['quantity']; ?>)
                                                                
                                                                <?php
                                                                // Fetch addons for this specific item
                                                                $addon_sql = "SELECT * FROM tb_order_item_addon WHERE order_item_id = '$current_item_id'";
                                                                $addon_result = mysqli_query($conn, $addon_sql);
                                                                
                                                                if (mysqli_num_rows($addon_result) > 0) {
                                                                    echo "<br> &nbsp;&nbsp;<small class='text-secondary'>Add-ons: ";
                                                                    $addon_list = [];
                                                                    while ($addon = mysqli_fetch_assoc($addon_result)) {
                                                                        $a_id = $addon['addon_id'];

                                                                        // Fetch addon name using old-school lookup query
                                                                        $a_name_sql = "SELECT addon_name FROM tb_addon WHERE addon_id = '$a_id'";
                                                                        $a_name_result = mysqli_query($conn, $a_name_sql);
                                                                        $a_row = mysqli_fetch_assoc($a_name_result);
                                                                        
                                                                        if ($a_row) {
                                                                            $addon_list[] = $a_row['addon_name'];
                                                                        }
                                                                    }
                                                                    // Print names separated by comma
                                                                    echo implode(', ', $addon_list);
                                                                    echo "</small>";
                                                                }
                                                                ?>
                                                            <?php } // End Item Loop ?>
                                                        </h6>                
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-12 text-end d-flex align-items-center justify-content-end gap-2">
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                                            <button type="submit" name="complete_order" class="btn rounded-3 complete">Complete Order</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php 
                                    } // End Pending Orders Loop
                                } 
                                ?>
                            </div>
                        </div>

                        <div class="col container">
                            <div class="row p-3" id="orders-content-title">
                                <h4>Order History</h4>
                            </div>

                            <div class="order-scrollbox">
                                <?php
                                // Fetch all Completed orders
                                $completed_sql = "SELECT * FROM tb_order WHERE order_status = 'Completed' ORDER BY order_date DESC";
                                $completed_result = mysqli_query($conn, $completed_sql);

                                if (mysqli_num_rows($completed_result) == 0) {
                                    echo "<p class='text-muted ps-3'>No completed orders yet.</p>";
                                } else {
                                    // Loop through each completed order
                                    while ($order = mysqli_fetch_assoc($completed_result)) {
                                        $current_order_id = $order['order_id'];
                                ?>
                                        <div class="row bg-white rounded-3 border mx-3 my-2 px-3 py-2">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title">Customer ID: <?php echo $order['user_id']; ?></h5>
                                                        <h6 class="card-subtitle mt-1 mb-2 text-muted">
                                                            Order ID: #<?php echo $order['order_id']; ?><br>
                                                            Date: <?php echo $order['order_date']; ?><br>
                                                            Total: ₱<?php echo number_format($order['total_price'], 2); ?>
                                                            <hr class="my-1">
                                                            <strong>Items Ordered:</strong>
                                                            
                                                            <?php
                                                            // Fetch items for this completed order
                                                            $item_sql = "SELECT * FROM tb_order_item WHERE order_id = '$current_order_id'";
                                                            $item_result = mysqli_query($conn, $item_sql);
                                                            
                                                            while ($item = mysqli_fetch_assoc($item_result)) {
                                                                $current_item_id = $item['order_item_id'];
                                                                $p_id = $item['product_id'];

                                                                // Fetch product name using standard lookup query
                                                                $p_name_sql = "SELECT product_name FROM tb_product WHERE product_id = '$p_id'";
                                                                $p_name_result = mysqli_query($conn, $p_name_sql);
                                                                $p_row = mysqli_fetch_assoc($p_name_result);
                                                                $product_name = $p_row ? $p_row['product_name'] : "Unknown Item";
                                                            ?>
                                                                <br> • <?php echo $product_name; ?> (x<?php echo $item['quantity']; ?>)
                                                                
                                                                <?php
                                                                // Fetch addons for this item
                                                                $addon_sql = "SELECT * FROM tb_order_item_addon WHERE order_item_id = '$current_item_id'";
                                                                $addon_result = mysqli_query($conn, $addon_sql);
                                                                
                                                                if (mysqli_num_rows($addon_result) > 0) {
                                                                    echo "<br> &nbsp;&nbsp;<small class='text-secondary'>Add-ons: ";
                                                                    $addon_list = [];
                                                                    while ($addon = mysqli_fetch_assoc($addon_result)) {
                                                                        $a_id = $addon['addon_id'];

                                                                        // Fetch addon name using standard lookup query
                                                                        $a_name_sql = "SELECT addon_name FROM tb_addon WHERE addon_id = '$a_id'";
                                                                        $a_name_result = mysqli_query($conn, $a_name_sql);
                                                                        $a_row = mysqli_fetch_assoc($a_name_result);
                                                                        
                                                                        if ($a_row) {
                                                                            $addon_list[] = $a_row['addon_name'];
                                                                        }
                                                                    }
                                                                    echo implode(', ', $addon_list);
                                                                    echo "</small>";
                                                                }
                                                                ?>
                                                            <?php } // End Item Loop ?>
                                                        </h6>        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php 
                                    } // End Completed Orders Loop
                                } 
                                ?>
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