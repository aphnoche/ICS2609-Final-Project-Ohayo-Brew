<?php
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

        .navbar {
            display: flex;
            justify-content: space-between; 
            align-items: center;           
            padding: 10px 20px;            
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 100px;
            margin-right: 50px;                    
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-family: 'New York Medium Regular', sans-serif;
            font-size: 20px;                                                                                  
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

        /* STICKY SIDEBAR NAV ALIGNMENT FIX (Mockup #2) */
        .sidebar-nav-container {
            padding-top: 40px;
            border-right: 1px solid #e0e0e0; /* Subtle border para visual separation */
        }
        
        .sidebar-nav {
            position: sticky;
            top: 40px; /* Distansya mula sa taas habang nag-scroll */
            display: flex;
            flex-direction: column;
            gap: 35px; /* Agwat sa pagitan ng bawat icon group */
            align-items: center;
            z-index: 100;
        }

        /* Ginawang flex para nakasentro ang text sa ilalim ng image */
        .sidebar-nav a {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
        }

        .sidebar-img {
            width: 45px; /* Tamang laki para sa pill layout icons ninyo */
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

        /* Curved Top Hero Banner */
        .cafe-banner {
            width: 100%;
            height: 250px;
            background: url('images/cafe-interior.jpg') no-repeat center center; /* Palitan ng inyong larawan */
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

            <div class="nav-links">
                <a href="login.php">Log-in</a>
                <input type="button" id="btn" value="Create an Account" onclick="window.location.href='createacc.php';">
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

                <div class="mb-5">
                    <h2 class="category-title" id="espresso">Espresso Crafts</h2>
                    <div class="row g-4">
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-espresso">
                                <div class="card-img-box">
                                    <img src="images/americano.jpg" alt="Americano">
                                </div>
                                <div class="product-title"><?php 
                                    $americano_sql = "SELECT product_name FROM tb_product WHERE product_id = 1";
                                    $americano_result = mysqli_query($conn, $americano_sql);
                                    $americano_row = mysqli_fetch_assoc($americano_result);
                                    echo $americano_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $americano_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 1 && size_name = 'Regular'";
                                    $americano_price_result = mysqli_query($conn, $americano_price_sql);
                                    $americano_price_row = mysqli_fetch_assoc($americano_price_result);
                                    echo '₱' . number_format($americano_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-espresso">
                                <div class="card-img-box">
                                    <img src="images/latte.jpg" alt="Cafe Latte">
                                </div>
                                <div class="product-title"><?php 
                                    $latte_sql = "SELECT product_name FROM tb_product WHERE product_id = 2";
                                    $latte_result = mysqli_query($conn, $latte_sql);
                                    $latte_row = mysqli_fetch_assoc($latte_result);
                                    echo $latte_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $latte_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 2 && size_name = 'Regular'";
                                    $latte_price_result = mysqli_query($conn, $latte_price_sql);
                                    $latte_price_row = mysqli_fetch_assoc($latte_price_result);
                                    echo '₱' . number_format($latte_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-espresso">
                                <div class="card-img-box">
                                    <img src="images/spanish-latte.jpg" alt="Spanish Latte">
                                </div>
                                <div class="product-title"><?php 
                                    $spanish_latte_sql = "SELECT product_name FROM tb_product WHERE product_id = 3";
                                    $spanish_latte_result = mysqli_query($conn, $spanish_latte_sql);
                                    $spanish_latte_row = mysqli_fetch_assoc($spanish_latte_result);
                                    echo $spanish_latte_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $spanish_latte_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 3 && size_name = 'Regular'";
                                    $spanish_latte_price_result = mysqli_query($conn, $spanish_latte_price_sql);
                                    $spanish_latte_price_row = mysqli_fetch_assoc($spanish_latte_price_result);
                                    echo '₱' . number_format($spanish_latte_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-espresso">
                                <div class="card-img-box">
                                    <img src="images/dark-mocha.jpg" alt="Dark Mocha">
                                </div>
                                <div class="product-title"><?php 
                                    $dark_mocha_sql = "SELECT product_name FROM tb_product WHERE product_id = 4";
                                    $dark_mocha_result = mysqli_query($conn, $dark_mocha_sql);
                                    $dark_mocha_row = mysqli_fetch_assoc($dark_mocha_result);
                                    echo $dark_mocha_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $dark_mocha_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 4 && size_name = 'Regular'";
                                    $dark_mocha_price_result = mysqli_query($conn, $dark_mocha_price_sql);
                                    $dark_mocha_price_row = mysqli_fetch_assoc($dark_mocha_price_result);
                                    echo '₱' . number_format($dark_mocha_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                <br><br>


                <div class="mb-5">
                    <h2 class="category-title" id="milk">Milk Crafts</h2>
                    <div class="row g-4">
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-milk">
                                <div class="card-img-box">
                                    <img src="images/strawberry-milk.jpg" alt="Strawberry Milk">
                                </div>
                                <div class="product-title"><?php 
                                    $strawberry_milk_sql = "SELECT product_name FROM tb_product WHERE product_id = 5";
                                    $strawberry_milk_result = mysqli_query($conn, $strawberry_milk_sql);
                                    $strawberry_milk_row = mysqli_fetch_assoc($strawberry_milk_result);
                                    echo $strawberry_milk_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $strawberry_milk_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 5 && size_name = 'Regular'";
                                    $strawberry_milk_price_result = mysqli_query($conn, $strawberry_milk_price_sql);
                                    $strawberry_milk_price_row = mysqli_fetch_assoc($strawberry_milk_price_result);
                                    echo '₱' . number_format($strawberry_milk_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-milk">
                                <div class="card-img-box">
                                    <img src="images/white-chocolate.jpg" alt="White Chocolate">
                                </div>
                                <div class="product-title"><?php 
                                    $white_chocolate_sql = "SELECT product_name FROM tb_product WHERE product_id = 6";
                                    $white_chocolate_result = mysqli_query($conn, $white_chocolate_sql);
                                    $white_chocolate_row = mysqli_fetch_assoc($white_chocolate_result);
                                    echo $white_chocolate_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $white_chocolate_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 6 && size_name = 'Regular'";
                                    $white_chocolate_price_result = mysqli_query($conn, $white_chocolate_price_sql);
                                    $white_chocolate_price_row = mysqli_fetch_assoc($white_chocolate_price_result);
                                    echo '₱' . number_format($white_chocolate_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        </a>
                    </div>
                </div>
                <br><br>


                <div class="mb-5">
                    <h2 class="category-title" id="tea">Tea Crafts</h2>
                    <div class="row g-4">
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-tea">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title"><?php 
                                    $yoghurt_peach_sql = "SELECT product_name FROM tb_product WHERE product_id = 7";
                                    $yoghurt_peach_result = mysqli_query($conn, $yoghurt_peach_sql);
                                    $yoghurt_peach_row = mysqli_fetch_assoc($yoghurt_peach_result);
                                    echo $yoghurt_peach_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $yoghurt_peach_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 7 && size_name = 'Regular'";
                                    $yoghurt_peach_price_result = mysqli_query($conn, $yoghurt_peach_price_sql);
                                    $yoghurt_peach_price_row = mysqli_fetch_assoc($yoghurt_peach_price_result);
                                    echo '₱' . number_format($yoghurt_peach_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-tea">
                                <div class="card-img-box">
                                    <img src="images/strawberry-black-tea.jpg" alt="Strawberry Black Tea">
                                </div>
                                <div class="product-title"><?php 
                                    $strawberry_black_tea_sql = "SELECT product_name FROM tb_product WHERE product_id = 8";
                                    $strawberry_black_tea_result = mysqli_query($conn, $strawberry_black_tea_sql);
                                    $strawberry_black_tea_row = mysqli_fetch_assoc($strawberry_black_tea_result);
                                    echo $strawberry_black_tea_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $strawberry_black_tea_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 8 && size_name = 'Regular'";
                                    $strawberry_black_tea_price_result = mysqli_query($conn, $strawberry_black_tea_price_sql);
                                    $strawberry_black_tea_price_row = mysqli_fetch_assoc($strawberry_black_tea_price_result);
                                    echo '₱' . number_format($strawberry_black_tea_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        </a>
                    </div>
                </div>
                <br><br>


                <div class="mb-5">
                    <h2 class="category-title" id="ice-blended">Ice Blended Crafts</h2>
                    <div class="row g-4">
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-ice-blended">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title"><?php 
                                    $peach_mango_sql = "SELECT product_name FROM tb_product WHERE product_id = 9";
                                    $peach_mango_result = mysqli_query($conn, $peach_mango_sql);
                                    $peach_mango_row = mysqli_fetch_assoc($peach_mango_result);
                                    echo $peach_mango_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $peach_mango_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 9 && size_name = 'Regular'";
                                    $peach_mango_price_result = mysqli_query($conn, $peach_mango_price_sql);
                                    $peach_mango_price_row = mysqli_fetch_assoc($peach_mango_price_result);
                                    echo '₱' . number_format($peach_mango_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-ice-blended">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title"><?php 
                                    $mixed_berries_sql = "SELECT product_name FROM tb_product WHERE product_id = 10";
                                    $mixed_berries_result = mysqli_query($conn, $mixed_berries_sql);
                                    $mixed_berries_row = mysqli_fetch_assoc($mixed_berries_result);
                                    echo $mixed_berries_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $mixed_berries_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 10 && size_name = 'Regular'";
                                    $mixed_berries_price_result = mysqli_query($conn, $mixed_berries_price_sql);
                                    $mixed_berries_price_row = mysqli_fetch_assoc($mixed_berries_price_result);
                                    echo '₱' . number_format($mixed_berries_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-ice-blended">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title"><?php 
                                    $double_choco_sql = "SELECT product_name FROM tb_product WHERE product_id = 11";
                                    $double_choco_result = mysqli_query($conn, $double_choco_sql);
                                    $double_choco_row = mysqli_fetch_assoc($double_choco_result);
                                    echo $double_choco_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $double_choco_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 11 && size_name = 'Regular'";
                                    $double_choco_price_result = mysqli_query($conn, $double_choco_price_sql);
                                    $double_choco_price_row = mysqli_fetch_assoc($double_choco_price_result);
                                    echo '₱' . number_format($double_choco_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        </a>
                    </div>
                </div>
                <br><br>

                <div class="mb-5">
                    <h2 class="category-title" id="matcha">Matcha Crafts</h2>
                    <div class="row g-4">
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-matcha">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title"><?php 
                                    $ohayo_uji_sql = "SELECT product_name FROM tb_product WHERE product_id = 12";
                                    $ohayo_uji_result = mysqli_query($conn, $ohayo_uji_sql);
                                    $ohayo_uji_row = mysqli_fetch_assoc($ohayo_uji_result);
                                    echo $ohayo_uji_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $ohayo_uji_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 12 && size_name = 'Regular'";
                                    $ohayo_uji_price_result = mysqli_query($conn, $ohayo_uji_price_sql);
                                    $ohayo_uji_price_row = mysqli_fetch_assoc($ohayo_uji_price_result);
                                    echo '₱' . number_format($ohayo_uji_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-matcha">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title"><?php 
                                    $ohayo_hojicha_sql = "SELECT product_name FROM tb_product WHERE product_id = 13";
                                    $ohayo_hojicha_result = mysqli_query($conn, $ohayo_hojicha_sql);
                                    $ohayo_hojicha_row = mysqli_fetch_assoc($ohayo_hojicha_result);
                                    echo $ohayo_hojicha_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $ohayo_hojicha_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 13 && size_name = 'Regular'";
                                    $ohayo_hojicha_price_result = mysqli_query($conn, $ohayo_hojicha_price_sql);
                                    $ohayo_hojicha_price_row = mysqli_fetch_assoc($ohayo_hojicha_price_result);
                                    echo '₱' . number_format($ohayo_hojicha_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="login.php" class="menu-link">
                            <div class="menu-card bg-matcha">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title"><?php 
                                    $matcha_kokuto_sql = "SELECT product_name FROM tb_product WHERE product_id = 14";
                                    $matcha_kokuto_result = mysqli_query($conn, $matcha_kokuto_sql);
                                    $matcha_kokuto_row = mysqli_fetch_assoc($matcha_kokuto_result);
                                    echo $matcha_kokuto_row['product_name'];
                                ?></div>
                                <div class="product-price"><?php 
                                    $matcha_kokuto_price_sql = "SELECT price FROM tb_product_size WHERE product_id = 14 && size_name = 'Regular'";
                                    $matcha_kokuto_price_result = mysqli_query($conn, $matcha_kokuto_price_sql);
                                    $matcha_kokuto_price_row = mysqli_fetch_assoc($matcha_kokuto_price_result);
                                    echo '₱' . number_format($matcha_kokuto_price_row['price'], 2);
                                ?></div>
                            </div>
                            </a>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>

    <a href="#" class="scroll-to-top">▲</a>

    <footer class="text-center py-5 mt-5 border-top bg-white">
        <div class="mb-2">
            <img src="images/logo.png" class="footer-logo-img" alt="OHAYO BREW">
        </div>
        <div class="text-muted small" style="font-size: 11px;">Copyright Infringement. All Rights Reserved. 2026.</div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>