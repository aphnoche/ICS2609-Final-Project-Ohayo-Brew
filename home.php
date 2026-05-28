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

        /* Group container for keeping checkout and profile items together */
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 60px;         /* Adjust this value to change space between checkout and profile */
            margin-right: 50px; /* Keeps the right side margin consistent with the original design */
        }

        .nav-links {
            display: flex;
            align-items: center;
        }

        .nav-links img {
            width: 30px; /* Set an explicit size for your checkout image if needed */
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
            /* margin-right: 50px; <-- Removed from here and moved to .navbar-right */
        }

        .profile-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* STICKY SIDEBAR NAV ALIGNMENT FIX (Mockup #2) */
        .sidebar-nav-container {
            padding-top: 40px;
            border-right: 1px solid #e0e0e0; 
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

                <div class="mb-5">
                    <h2 class="category-title" id="espresso">Espresso Crafts</h2>
                    <div class="row g-4">
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="product.php?pid=1" class="menu-link">
                            <div class="menu-card bg-espresso">
                                <div class="card-img-box">
                                    <img src="images/americano.jpg" alt="Americano">
                                </div>
                                <div class="product-title"><?php 
                    
                                ?></div>
                                <div class="product-price">₱120.00</div>
                            </div>
                            </a>
                        </div>
                        
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="product.php?pid=2" class="menu-link">
                            <div class="menu-card bg-espresso">
                                <div class="card-img-box">
                                    <img src="images/latte.jpg" alt="Cafe Latte">
                                </div>
                                <div class="product-title"><?php 
                                
                                ?></div>
                                <div class="product-price">₱130.00</div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="product.php?pid=3" class="menu-link">
                            <div class="menu-card bg-espresso">
                                <div class="card-img-box">
                                    <img src="images/spanish-latte.jpg" alt="Spanish Latte">
                                </div>
                                <div class="product-title">Spanish Latte</div>
                                <div class="product-price">₱140.00</div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="product.php?pid=4" class="menu-link">
                            <div class="menu-card bg-espresso">
                                <div class="card-img-box">
                                    <img src="images/dark-mocha.jpg" alt="Dark Mocha">
                                </div>
                                <div class="product-title">Dark Mocha</div>
                                <div class="product-price">₱150.00</div>
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
                            <a href="product.php?pid=5" class="menu-link">
                            <div class="menu-card bg-milk">
                                <div class="card-img-box">
                                    <img src="images/strawberry-milk.jpg" alt="Strawberry Milk">
                                </div>
                                <div class="product-title">Strawberry Milk</div>
                                <div class="product-price">₱120.00</div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="product.php?pid=6" class="menu-link">
                            <div class="menu-card bg-milk">
                                <div class="card-img-box">
                                    <img src="images/white-chocolate.jpg" alt="White Chocolate">
                                </div>
                                <div class="product-title">White Chocolate</div>
                                <div class="product-price">₱130.00</div>
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
                            <a href="product.php?pid=7" class="menu-link">
                            <div class="menu-card bg-tea">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title">Yoghurt Peach Tea</div>
                                <div class="product-price">₱130.00</div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="product.php?pid=8" class="menu-link">
                            <div class="menu-card bg-tea">
                                <div class="card-img-box">
                                    <img src="images/strawberry-black-tea.jpg" alt="Strawberry Black Tea">
                                </div>
                                <div class="product-title">Strawberry Black Tea</div>
                                <div class="product-price">₱130.00</div>
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
                            <a href="product.php?pid=9" class="menu-link">
                            <div class="menu-card bg-ice-blended">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title">Yoghurt Peach Tea</div>
                                <div class="product-price">₱130.00</div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="product.php?pid=10" class="menu-link">
                            <div class="menu-card bg-ice-blended">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title">Yoghurt Peach Tea</div>
                                <div class="product-price">₱130.00</div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="product.php?pid=11" class="menu-link">
                            <div class="menu-card bg-ice-blended">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title">Strawberry Black Tea</div>
                                <div class="product-price">₱130.00</div>
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
                            <a href="product.php?pid=12" class="menu-link">
                            <div class="menu-card bg-matcha">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title"><?php echo "Matcha 1"?></div>
                                <div class="product-price"><?php echo "₱130.00"?></div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="product.php?pid=13" class="menu-link">
                            <div class="menu-card bg-matcha">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title"><?php echo "Matcha 2"?></div>
                                <div class="product-price"><?php echo "₱130.00"?></div>
                            </div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="product.php?pid=14" class="menu-link">
                            <div class="menu-card bg-matcha">
                                <div class="card-img-box">
                                    <img src="images/yoghurt-peach.jpg" alt="Yoghurt Peach Tea">
                                </div>
                                <div class="product-title"><?php echo "Matcha 3"?></div>
                                <div class="product-price"><?php echo "₱130.00"?></div>
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

<?php

?>