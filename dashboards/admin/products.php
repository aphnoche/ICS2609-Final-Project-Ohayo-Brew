<?php
require_once '../../db_ohayo_conn.php';
session_start();

// 1. HANDLE AVAILABILITY TOGGLE (When the status button is clicked)
if (isset($_POST['toggle_availability'])) {
    $product_id = $_POST['product_id'];
    $current_status = $_POST['current_status'];

    // Toggle the status string
    $new_status = ($current_status === 'Available') ? 'Unavailable' : 'Available';

    // Update statement (assuming your column name is 'availability')
    $update_sql = "UPDATE tb_product SET availability = '$new_status' WHERE product_id = '$product_id'";
    mysqli_query($conn, $update_sql);

    // Refresh page to show updated status
    header("Location: products.php");
    exit();
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
    img {
        object-fit: cover;
    }

    body {
        font-family: "New York Medium Regular";
    }

    #products {
        background-color: #eee8e0;
    }

    #products-content {
        min-height: 100%;
        background-color: #eee8e0;
    }

    .products-content-title {
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

    .Edit {
        background-color: #a7794b;
        color: white;
    }

    .Edit:hover {
        background-color: #a7794b;
        color: white;
    }

    .status-btn {
        padding: 6px 12px;
        border: none;
        font-size: 14px;
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
                    <a href="logout.php"><img src="images/user.png" alt="Profile"></a>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Using a LEFT JOIN to link products with their 'Regular' price from the size table
    $show_ac = "SELECT p.*, s.price AS total_price 
            FROM tb_product p 
            LEFT JOIN tb_product_size s ON p.product_id = s.product_id AND s.size_name = 'Regular'";
    $res_ac = $conn->query($show_ac);
    ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <h2 style="font-family: 'New York Large Bold'">Hello, Admin!</h2>
                    </div>
                    <div class="row text-center p-4 my-4">
                        <h5><a href="admindash.php" style="font-family: 'New York Large'"
                                class="link-underline link-underline-opacity-0 text-dark">Order List</a></h5>
                    </div>
                    <div class="row text-center rounded-4 p-4 my-4" id="products">
                        <h5><a href="products.php" style="font-family: 'New York Large'"
                                class="link-underline link-underline-opacity-0 text-dark">Products List</a></h5>
                    </div>
                    <div class="row text-center p-4 my-4">
                        <h5><a href="logs.php" style="font-family: 'New York Large'"
                                class="link-underline link-underline-opacity-0 text-dark">Logs</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-9">
                <div class="container rounded-4" id="products-content">
                    <div class="row p-3">
                        <h4 class="products-content-title">Products</h4>
                    </div>

                    <div style="max-height: 450px; overflow-y: auto; overflow-x: hidden; padding-bottom: 10px;">
                        <?php
                        if ($res_ac->num_rows > 0) {
                            foreach ($res_ac as $fieldname_ac) {
                                $prod_status = (!empty($fieldname_ac['availability'])) ? $fieldname_ac['availability'] : 'Available';
                                $btn_class = ($prod_status === 'Unavailable') ? 'bg-danger' : 'bg-success';
                                ?>
                                <div class="row bg-white rounded-3 border mx-3 my-2 px-3 py-2">
                                    <div class="container">
                                        <div class="row align-items-center">
                                            <div class="col-2 border bg-dark p-2 rounded-3 text-center d-flex align-items-center justify-content-center"
                                                style="height: 100px;">
                                                <?php
                                                // Check if image is not null, not completely blank, and isn't just the word 'NULL'
                                                if (!empty($fieldname_ac['image']) && trim($fieldname_ac['image']) !== '' && strtoupper($fieldname_ac['image']) !== 'NULL'):

                                                    // Foolproof path check: If the DB already says "images/...", just use it. Otherwise, add "images/"
                                                    $image_path = $fieldname_ac['image'];
                                                    if (strpos($image_path, 'images/') === false) {
                                                        $image_path = 'images/' . $image_path;
                                                    }
                                                    ?>
                                                    <img src="<?php echo $image_path; ?>" alt="Product"
                                                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                                <?php else: ?>
                                                    <span class="text-white" style="font-size: 11px;">No Image Available</span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="col container px-4 pt-1">
                                                <div class="row">
                                                    <h5><?php echo $fieldname_ac['product_name']; ?></h5>
                                                </div>
                                                <div class="row">
                                                    <p class="text-muted mb-2">Description:
                                                        <?php echo $fieldname_ac['description']; ?><br>Price:
                                                        ₱<?php echo $fieldname_ac['total_price']; ?></p>
                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col-8"></div>
                                                    <div class="col-2 text-end">
                                                        <a href="editproduct.php?id=<?php echo $fieldname_ac['product_id']; ?>&name=<?php echo $fieldname_ac['product_name']; ?>"
                                                            class="btn rounded-3 Edit btn-sm">Edit/Remove</a>
                                                    </div>
                                                    <div class="col-2 text-end">
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="product_id"
                                                                value="<?php echo $fieldname_ac['product_id']; ?>">
                                                            <input type="hidden" name="current_status"
                                                                value="<?php echo $prod_status; ?>">
                                                            <button type="submit" name="toggle_availability"
                                                                class="rounded-3 text-white status-btn btn-sm <?php echo $btn_class; ?>">
                                                                <?php echo $prod_status; ?>
                                                            </button>
                                                        </form>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>