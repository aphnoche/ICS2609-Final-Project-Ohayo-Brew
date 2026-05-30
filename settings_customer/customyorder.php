<?php
session_start();
require_once '../db_ohayo_conn.php'; // Include your database connection file

// Fetch current user ID from session, default to 1 for testing if session isn't set yet
$user_id = $_SESSION['user_id'] ?? 1;

// Fetch all orders for this user, sorted by newest order first
$orders_sql = "SELECT * FROM tb_order WHERE user_id = $user_id ORDER BY order_id DESC";
$orders_result = mysqli_query($conn, $orders_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Settings - My Orders</title>
    <link rel="stylesheet" href="../font-family.css">
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
        min-height: 500px;
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

    .status-badge {
        font-size: 12px;
        font-family: "New York Medium Regular";
        font-weight: bold;
    }
    .sticky-top{
        top: 60px;
    }

    .orders-scrollview {
            max-height: 400px; 
            overflow-y: auto;
            padding-bottom: 15px;
        }

</style> 
<body>
    <div class="header-bar d-flex justify-content-between align-items-center">
        <div>
            <img src="../images/logo.png" alt="Ohayo Brew Logo" class="logo-img">
        </div>
        <div class="profile-icon">
            <img src="../images/user.png" alt="Profile">
        </div>
    </div>

    <div class="container" id="menu">
        <div class="row">
            <!-- Sidebar Navigation Links -->
            <div class="col-md-3">
                <div class="container sticky-top">
                    <div class="row">
                        <h2><b>Settings</b></h2>
                    </div>
                     <div class="row text-center rounded-4 p-4 my-3" id="orders">
                        <h5><a href="customyorder.php" class="link-underline link-underline-opacity-0 text-dark">My Order</a></h5>
                    </div>
                     <div class="row text-center p-4 my-3">
                        <h5><a href="custoaccount.php" class="link-underline link-underline-opacity-0 text-dark">Accounts</a></h5>
                    </div>
                     <div class="row text-center p-4 my-3">
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

            <!-- Main Dynamic Content Panel -->
            <div class="col-md-9">
                <div class="container rounded-4 pb-1" id="orders-content">
                    <div class="row p-3" id="orders-content-title">
                        <h4>My Orders</h4>
                    </div>
                    
                    <!-- NEW: Scrollview wrapper element starts here -->
                    <div class="orders-scrollview">
                        <?php 
                        if (mysqli_num_rows($orders_result) > 0): 
                            while ($order = mysqli_fetch_assoc($orders_result)): 
                                $order_id = $order['order_id'];
                                
                                // Determine status badge background colors safely
                                $status = htmlspecialchars($order['order_status']);
                                $bg_color = '#a7794b'; // Default template brown for Pending
                                if ($status == 'Processing') $bg_color = '#2574A9'; // Blue
                                if ($status == 'Completed') $bg_color = '#27AE60';  // Green
                                if ($status == 'Cancelled') $bg_color = '#96281B';  // Red

                                // Query all individual menu item details mapped inside this order structure
                                $items_sql = "SELECT oi.quantity, p.product_name 
                                              FROM tb_order_item oi 
                                              JOIN tb_product p ON oi.product_id = p.product_id 
                                              WHERE oi.order_id = $order_id";
                                $items_result = mysqli_query($conn, $items_sql);
                        ?>
                         <!-- Render dynamic container card for each historical transaction -->
                         <div class="row bg-white rounded border mx-3 my-2 px-3 py-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="fw-bold text-dark">Order Reference #<?php echo $order_id; ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Tracking Reference</h6>
                                    </div>
                                    <div class="col d-flex align-items-center justify-content-end gap-4">
                                        <div class="rounded-3 p-2 text-white status-badge" style="background-color: <?php echo $bg_color; ?>;">
                                            <?php echo $status; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Product Breakdown Row -->
                                <div class="row my-2">
                                    <div class="col">
                                        <?php 
                                        if ($items_result && mysqli_num_rows($items_result) > 0) {
                                            while ($item = mysqli_fetch_assoc($items_result)) {
                                                echo "<h5 class='mb-1'>" . htmlspecialchars($item['product_name']) . " <span class='text-muted small'>x" . $item['quantity'] . "</span></h5>";
                                            }
                                        } else {
                                            echo "<h5 class='text-muted italic'>Custom Brew Blend Details</h5>";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <!-- Footer Row containing Timestamps and Totals -->
                                <div class="row mt-4">
                                    <table class="w-100">
                                        <tbody>
                                            <tr>
                                                <td class="text-muted align-text-bottom small">
                                                    Order Date: <?php echo isset($order['order_date']) ? date('Y-m-d H:i', strtotime($order['order_date'])) : date('Y-m-d'); ?>
                                                </td>
                                                <td>&nbsp;</td>
                                                <td class="text-end align-text-bottom fw-bold text-dark fs-5">
                                                    Total: ₱<?php echo number_format($order['total_price'], 2); ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
                        <?php 
                            endwhile; 
                        else: 
                        ?>
                            <!-- Fallback visual state if transaction history is clean -->
                            <div class="text-center py-5">
                                <h5 class="text-muted">You haven't placed any orders yet.</h5>
                                <a href="home.php" class="btn btn-sm btn-outline-dark mt-2">Browse the Menu</a>
                            </div>
                        <?php endif; ?>
                    </div>


                </div>
            </div>
        </div>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>