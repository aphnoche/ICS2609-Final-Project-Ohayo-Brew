<?php
    session_start();
    require_once 'db_ohayo_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Ohayo Brew</title>
    <link rel="stylesheet" href="font-family.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">  
    <style>
        body {
            background-color: #ffffff;
            color: #333333;
        }


        /*NAVBAR FUNCTIONALITY*/ 

        .navbar {
            display: flex;
            justify-content: space-between; 
            align-items: center;          
            padding: 10px 20px;            
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 60px;         
            margin-right: 50px; 
        }

        .nav-links {
            display: flex;
            align-items: center;
        }



        .nav-links img {
            width: 30px;
            height: auto;
        }



        #btn {
            border: 3px solid #333;
            border-radius: 8px;
            padding: 10px 20px;
            font-family: 'New York Medium Regular', sans-serif;
            font-size: 20px;
            cursor: pointer;
            background: transparent;
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

        /* STICKY SIDEBAR NAV */
        .sidebar-nav-container {
            padding-top: 40px;
            border-right: 1px solid #e0e0e0; 
        }

        

        .sidebar-nav {
            position: sticky;
            top: 40px;
            display: flex;
            flex-direction: column;
            gap: 35px; 
            align-items: center;
            z-index: 100;
        }


        .sidebar-nav a {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
        }



        .sidebar-img {
            width: 45px;
            height: auto;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .sidebar-img:hover {
            transform: scale(1.05);
        }

        .sidebar-text {
            font-family: 'New York Medium Regular', sans-serif;
            font-size: 11px;
            font-weight: 500;
            color: #333333;
            margin-top: 8px;
            margin-bottom: 0;
            line-height: 1.2;
        }



        /*Cafe Banner*/
        .cafe-banner {
            width: 100%;
            height: 250px;
            background: url('images/cafe-interior.jpg') no-repeat center center;
            background-size: cover;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
            box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.05);
        }



        /* Category Header Fonts */

        .category-title {
            font-family: 'New York Large Bold', sans-serif;
            font-size: 24px;
            font-weight: 600;
            margin-top: 40px;
            margin-bottom: 20px;
            color: #2b2b2b;
        }



        /* Custom Product Card Designs */

        .menu-card {
            border: none;
            border-radius: 18px;
            padding: 15px;
            text-align: center;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px);
        }



        .menu-link {
            text-decoration: none; 
            color: inherit;        
            display: block;      
        }



        .menu-link:hover {
            text-decoration: none;
            color: inherit;
        }



        /* Background Palettes para sa bawat Category Box */

        .bg-espresso { background-color: #9C6644; }
        .bg-milk { background-color: #7794a3; }
        .bg-tea { background-color: #a37272; }
        .bg-ice-blended { background-color: #9e975c; }
        .bg-matcha { background-color: #637a5b; }



        /* White Frame Inner Box For Image */
        .card-img-box {
            width: 100%;
            height: 200px;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-title {
            font-size: 16px;
            font-style: italic;
            margin-top: 15px;
            margin-bottom: 2px;
            font-weight: 400;
        }

        .product-price {
            font-size: 12px;
            font-weight: 300;
            opacity: 0.9;
        }

        /* Floating Back-To-Top Button */
        .scroll-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 45px;
            height: 45px;
            background-color: #2b3a4a;
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            z-index: 101;
        }

        .scroll-to-top:hover {
            color: #ffffff;
            opacity: 0.9;
        }

        /* Footer Logo Image Formatting */
        .footer-logo-img {
            max-width: 130px;
            height: auto;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
   <div class="container-navbar">
        <div class="navbar">
            <div class="logo">
                <img src="images/logo.png" alt="Ohayo Brew Logo" style="width: 200px; height: auto; margin-left: 50px;">
            </div>
           
            <div class="navbar-right">
                <div class="nav-links">
                    <a href="checkout.php"><img src="images/checkout.png" alt="Checkout"></a>
                </div>
                <div class="profile-icon">
                    <a href="settings_customer/custoaccount.php"><img src="images/user.png" alt="Profile"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
           
            <div class="col-md-1 d-none d-md-block sidebar-nav-container">
                <div class="sidebar-nav">
                    <a href="noacchome.php#espresso"><img src="images/category/espresso-crafts.png" class="sidebar-img"><p class="sidebar-text">Espresso Crafts</p></a>
                    <a href="noacchome.php#milk"><img src="images/category/tea-milk-crafts.png" class="sidebar-img"><p class="sidebar-text">Milk Crafts</p></a>
                    <a href="noacchome.php#tea"><img src="images/category/tea-milk-crafts.png" class="sidebar-img"><p class="sidebar-text">Tea Crafts</p></a>
                    <a href="noacchome.php#ice-blended"><img src="images/category/ice-blended.png" class="sidebar-img"><p class="sidebar-text">Ice Blended Crafts</p></a>
                    <a href="noacchome.php#matcha"><img src="images/category/matcha-crafts.png" class="sidebar-img"><p class="sidebar-text">Matcha Crafts</p></a>
                </div>
            </div>

            <div class="col-12 col-md-11 px-4">
                
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="cafe-banner">
                            <img src="images/home-heading.jpg" alt="Cafe Interior" style="width: 100%; height: 100%; object-fit: cover; border-bottom-left-radius: 40px; border-bottom-right-radius: 40px;">
                        </div>
                    </div>
                </div>

                <div class="mb-5 mt-5">
                    <h2 class="category-title" id="espresso">Espresso Crafts</h2>
                    <div class="row g-4">
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $americano_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 1";
                                $americano_result = $conn->query($americano_sql);
                                $americano_row = $americano_result->fetch_assoc();

                                $americano_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 1 && size_name = 'Regular'";
                                $americano_price_result = $conn->query($americano_price_sql);
                                $americano_price_row = $americano_price_result->fetch_assoc();
                            ?>
                            
                            <?php if ($americano_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-espresso" style="opacity: 0.5;">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/<?php echo $americano_row['image']; ?>" alt="Americano">
                                        </div>
                                    <div class="product-title"><?php echo $americano_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($americano_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=1" class="menu-link">
                                    <div class="menu-card bg-espresso">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($americano_row['image']); ?>" alt="Americano">
                                        </div>
                                        <div class="product-title"><?php echo $americano_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($americano_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $latte_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 2";
                                $latte_result = $conn->query($latte_sql);
                                $latte_row = $latte_result->fetch_assoc();

                                $latte_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 2 && size_name = 'Regular'";
                                $latte_price_result = $conn->query($latte_price_sql);
                                $latte_price_row = $latte_price_result->fetch_assoc();
                            ?>

                            <?php if ($latte_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-espresso" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($latte_row['image']); ?>" alt="Americano">
                                    </div>
                                    <div class="product-title"><?php echo $latte_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($latte_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=2" class="menu-link">
                                    <div class="menu-card bg-espresso">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($latte_row['image']); ?>" alt="<?php echo $latte_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $latte_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($latte_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $spanish_latte_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 3";
                                $spanish_latte_result = $conn->query($spanish_latte_sql);
                                $spanish_latte_row = $spanish_latte_result->fetch_assoc();

                                $spanish_latte_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 3 && size_name = 'Regular'";
                                $spanish_latte_price_result = $conn->query($spanish_latte_price_sql);
                                $spanish_latte_price_row = $spanish_latte_price_result->fetch_assoc();
                            ?>

                            <?php if ($spanish_latte_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-espresso" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($spanish_latte_row['image']); ?>" alt="<?php echo $spanish_latte_row['product_name']; ?>">
                                    </div>
                                    <div class="product-title"><?php echo $spanish_latte_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($spanish_latte_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=3" class="menu-link">
                                    <div class="menu-card bg-espresso">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($spanish_latte_row['image']); ?>" alt="<?php echo $spanish_latte_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $spanish_latte_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($spanish_latte_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $dark_mocha_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 4";
                                $dark_mocha_result = $conn->query($dark_mocha_sql);
                                $dark_mocha_row = $dark_mocha_result->fetch_assoc();

                                $dark_mocha_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 4 && size_name = 'Regular'";
                                $dark_mocha_price_result = $conn->query($dark_mocha_price_sql);
                                $dark_mocha_price_row = $dark_mocha_price_result->fetch_assoc();
                            ?>

                            <?php if ($dark_mocha_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-espresso" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($dark_mocha_row['image']); ?>" alt="<?php echo $dark_mocha_row['product_name']; ?>">
                                    </div>
                                    <div class="product-title"><?php echo $dark_mocha_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($dark_mocha_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=4" class="menu-link">
                                    <div class="menu-card bg-espresso">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($dark_mocha_row['image']); ?>" alt="<?php echo $dark_mocha_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $dark_mocha_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($dark_mocha_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <br><br>

                <div class="mb-5">
                    <h2 class="category-title" id="milk">Milk Crafts</h2>
                    <div class="row g-4">
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $strawberry_milk_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 5";
                                $strawberry_milk_result = $conn->query($strawberry_milk_sql);
                                $strawberry_milk_row = $strawberry_milk_result->fetch_assoc();

                                $strawberry_milk_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 5 AND size_name = 'Regular'";
                                $strawberry_milk_price_result = $conn->query($strawberry_milk_price_sql);
                                $strawberry_milk_price_row = $strawberry_milk_price_result->fetch_assoc();
                            ?>

                            <?php if ($strawberry_milk_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-milk" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($strawberry_milk_row['image']); ?>" alt="<?php echo $strawberry_milk_row['product_name']; ?>">
                                    </div>
                                    <div class="product-title"><?php echo $strawberry_milk_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($strawberry_milk_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=5" class="menu-link">
                                    <div class="menu-card bg-milk">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($strawberry_milk_row['image']); ?>" alt="<?php echo $strawberry_milk_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $strawberry_milk_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($strawberry_milk_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $white_chocolate_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 6";
                                $white_chocolate_result = $conn->query($white_chocolate_sql);
                                $white_chocolate_row = $white_chocolate_result->fetch_assoc();

                                $white_chocolate_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 6 AND size_name = 'Regular'";
                                $white_chocolate_price_result = $conn->query($white_chocolate_price_sql);
                                $white_chocolate_price_row = $white_chocolate_price_result->fetch_assoc();
                            ?>

                            <?php if ($white_chocolate_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-milk" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($white_chocolate_row['image']); ?>" alt="<?php echo $white_chocolate_row['product_name']; ?>">
                                    </div>
                                    <div class="product-title"><?php echo $white_chocolate_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($white_chocolate_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=6" class="menu-link">
                                    <div class="menu-card bg-milk">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($white_chocolate_row['image']); ?>" alt="<?php echo $white_chocolate_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $white_chocolate_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($white_chocolate_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <br><br>

                <div class="mb-5">
                    <h2 class="category-title" id="tea">Tea Crafts</h2>
                    <div class="row g-4">
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $yoghurt_peach_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 7";
                                $yoghurt_peach_result = $conn->query($yoghurt_peach_sql);
                                $yoghurt_peach_row = $yoghurt_peach_result->fetch_assoc();

                                $yoghurt_peach_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 7 AND size_name = 'Regular'";
                                $yoghurt_peach_price_result = $conn->query($yoghurt_peach_price_sql);
                                $yoghurt_peach_price_row = $yoghurt_peach_price_result->fetch_assoc();
                            ?>

                            <?php if ($yoghurt_peach_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-tea" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($yoghurt_peach_row['image']); ?>" alt="<?php echo $yoghurt_peach_row['product_name']; ?>">
                                    </div>
                                    <div class="product-title"><?php echo $yoghurt_peach_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($yoghurt_peach_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=7" class="menu-link">
                                    <div class="menu-card bg-tea">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($yoghurt_peach_row['image']); ?>" alt="<?php echo $yoghurt_peach_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $yoghurt_peach_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($yoghurt_peach_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $strawberry_black_tea_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 8";
                                $strawberry_black_tea_result = $conn->query($strawberry_black_tea_sql);
                                $strawberry_black_tea_row = $strawberry_black_tea_result->fetch_assoc();

                                $strawberry_black_tea_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 8 AND size_name = 'Regular'";
                                $strawberry_black_tea_price_result = $conn->query($strawberry_black_tea_price_sql);
                                $strawberry_black_tea_price_row = $strawberry_black_tea_price_result->fetch_assoc();
                            ?>

                            <?php if ($strawberry_black_tea_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-tea" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($strawberry_black_tea_row['image']); ?>" alt="<?php echo $strawberry_black_tea_row['product_name']; ?>">
                                    </div>
                                    <div class="product-title"><?php echo $strawberry_black_tea_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($strawberry_black_tea_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=8" class="menu-link">
                                    <div class="menu-card bg-tea">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($strawberry_black_tea_row['image']); ?>" alt="<?php echo $strawberry_black_tea_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $strawberry_black_tea_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($strawberry_black_tea_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <br><br>

                <div class="mb-5">
                    <h2 class="category-title" id="ice-blended">Ice Blended Crafts</h2>
                    <div class="row g-4">
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $peach_mango_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 9";
                                $peach_mango_result = $conn->query($peach_mango_sql);
                                $peach_mango_row = $peach_mango_result->fetch_assoc();

                                $peach_mango_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 9 AND size_name = 'Regular'";
                                $peach_mango_price_result = $conn->query($peach_mango_price_sql);
                                $peach_mango_price_row = $peach_mango_price_result->fetch_assoc();
                            ?>

                            <?php if ($peach_mango_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-ice-blended" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($peach_mango_row['image']); ?>" alt="<?php echo $peach_mango_row['product_name']; ?>">
                                    </div>
                                    <div class="product-title"><?php echo $peach_mango_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($peach_mango_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=9" class="menu-link">
                                    <div class="menu-card bg-ice-blended">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($peach_mango_row['image']); ?>" alt="<?php echo $peach_mango_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $peach_mango_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($peach_mango_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $mixed_berries_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 10";
                                $mixed_berries_result = $conn->query($mixed_berries_sql);
                                $mixed_berries_row = $mixed_berries_result->fetch_assoc();

                                $mixed_berries_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 10 AND size_name = 'Regular'";
                                $mixed_berries_price_result = $conn->query($mixed_berries_price_sql);
                                $mixed_berries_price_row = $mixed_berries_price_result->fetch_assoc();
                            ?>

                            <?php if ($mixed_berries_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-ice-blended" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($mixed_berries_row['image']); ?>" alt="<?php echo $mixed_berries_row['product_name']; ?>">
                                    </div>
                                    <div class="product-title"><?php echo $mixed_berries_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($mixed_berries_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=10" class="menu-link">
                                    <div class="menu-card bg-ice-blended">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($mixed_berries_row['image']); ?>" alt="<?php echo $mixed_berries_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $mixed_berries_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($mixed_berries_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $double_choco_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 11";
                                $double_choco_result = $conn->query($double_choco_sql);
                                $double_choco_row = $double_choco_result->fetch_assoc();

                                $double_choco_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 11 AND size_name = 'Regular'";
                                $double_choco_price_result = $conn->query($double_choco_price_sql);
                                $double_choco_price_row = $double_choco_price_result->fetch_assoc();
                            ?>

                            <?php if ($double_choco_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-ice-blended" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($double_choco_row['image']); ?>" alt="<?php echo $double_choco_row['product_name']; ?>">
                                    </div>
                                    <div class="product-title"><?php echo $double_choco_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($double_choco_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=11" class="menu-link">
                                    <div class="menu-card bg-ice-blended">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($double_choco_row['image']); ?>" alt="<?php echo $double_choco_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $double_choco_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($double_choco_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <br><br>

                <div class="mb-5">
                    <h2 class="category-title" id="matcha">Matcha Crafts</h2>
                    <div class="row g-4">
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $ohayo_uji_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 12";
                                $ohayo_uji_result = $conn->query($ohayo_uji_sql);
                                $ohayo_uji_row = $ohayo_uji_result->fetch_assoc();

                                $ohayo_uji_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 12 AND size_name = 'Regular'";
                                $ohayo_uji_price_result = $conn->query($ohayo_uji_price_sql);
                                $ohayo_uji_price_row = $ohayo_uji_price_result->fetch_assoc();
                            ?>

                            <?php if ($ohayo_uji_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-matcha" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($ohayo_uji_row['image']); ?>" alt="<?php echo $ohayo_uji_row['product_name']; ?>">
                                    </div>
                                    <div class="product-title"><?php echo $ohayo_uji_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($ohayo_uji_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=12" class="menu-link">
                                    <div class="menu-card bg-matcha">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($ohayo_uji_row['image']); ?>" alt="<?php echo $ohayo_uji_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $ohayo_uji_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($ohayo_uji_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $ohayo_hojicha_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 13";
                                $ohayo_hojicha_result = $conn->query($ohayo_hojicha_sql);
                                $ohayo_hojicha_row = $ohayo_hojicha_result->fetch_assoc();

                                $ohayo_hojicha_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 13 AND size_name = 'Regular'";
                                $ohayo_hojicha_price_result = $conn->query($ohayo_hojicha_price_sql);
                                $ohayo_hojicha_price_row = $ohayo_hojicha_price_result->fetch_assoc();
                            ?>

                            <?php if ($ohayo_hojicha_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-matcha" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($ohayo_hojicha_row['image']); ?>" alt="<?php echo $ohayo_hojicha_row['product_name']; ?>">
                                    </div>
                                    <div class="product-title"><?php echo $ohayo_hojicha_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($ohayo_hojicha_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=13" class="menu-link">
                                    <div class="menu-card bg-matcha">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($ohayo_hojicha_row['image']); ?>" alt="<?php echo $ohayo_hojicha_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $ohayo_hojicha_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($ohayo_hojicha_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <?php
                                $matcha_kokuto_sql = "SELECT product_name, availability, image FROM tb_product WHERE product_id = 14";
                                $matcha_kokuto_result = $conn->query($matcha_kokuto_sql);
                                $matcha_kokuto_row = $matcha_kokuto_result->fetch_assoc();

                                $matcha_kokuto_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 14 AND size_name = 'Regular'";
                                $matcha_kokuto_price_result = $conn->query($matcha_kokuto_price_sql);
                                $matcha_kokuto_price_row = $matcha_kokuto_price_result->fetch_assoc();
                            ?>

                            <?php if ($matcha_kokuto_row['availability'] == 'Unavailable') { ?>
                                <div class="menu-card bg-matcha" style="opacity: 0.5;">
                                    <div class="card-img-box">
                                        <img src="dashboards/admin/images/<?php echo basename($matcha_kokuto_row['image']); ?>" alt="<?php echo $matcha_kokuto_row['product_name']; ?>">
                                    </div>
                                    <div class="product-title"><?php echo $matcha_kokuto_row['product_name']; ?> <span class="text-danger font-weight-bold">(Sold Out)</span></div>
                                    <div class="product-price"><?php echo '₱' . number_format($matcha_kokuto_price_row['price'], 2); ?></div>
                                </div>
                            <?php } else { ?>
                                <a href="product.php?product_id=14" class="menu-link">
                                    <div class="menu-card bg-matcha">
                                        <div class="card-img-box">
                                            <img src="dashboards/admin/images/<?php echo basename($matcha_kokuto_row['image']); ?>" alt="<?php echo $matcha_kokuto_row['product_name']; ?>">
                                        </div>
                                        <div class="product-title"><?php echo $matcha_kokuto_row['product_name']; ?></div>
                                        <div class="product-price"><?php echo '₱' . number_format($matcha_kokuto_price_row['price'], 2); ?></div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        
                    </div>
                </div>

            </div> </div>
    </div>

    <a href="#" class="scroll-to-top">▲</a>

    <footer class="text-center py-5 mt-5 border-top bg-white">
        <div class="mb-2">
            <img src="images/logo.png" class="footer-logo-img" alt="OHAYO BREW">
        </div>
        <div class="text-muted small" style="font-size: 11px;">&copy; Ohayo Brew. All Rights Reserved. 2026.</div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>