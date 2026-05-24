<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ohayo Brew!</title>
    <link rel="stylesheet" href="font-family.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden; 
        }

        body {
            background-image: url('images/landing-bg.png');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column; 
        }

        .navbar {
            display: flex;
            justify-content: space-between; 
            align-items: center;           
            padding: 20px 20px;            
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
            border: 5px solid #333;
            border-radius: 8px;
            padding: 10px 20px;
            font-family: 'New York Medium Regular', sans-serif;
            font-size: 20px;            
            cursor: pointer;
            background: transparent;
        }

        .hero-section {
            flex: 1; 
            display: flex;
            align-items: center; 
        }

        .hero-text-container {
            margin-left: 150px;   
            max-width: 900px;    
        }

        .hero-title {
            font-family: 'New York Large Bold', serif;
            color: #2D3748; 
            line-height: 1.1; 
            font-size: 7.8rem; 
        }

        .hero-btn {
            background-color: #1A365D;
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'New York Medium Regular', sans-serif;
            font-style: italic;
            padding: 14px 45px; 
            font-size: 21px;  
            text-decoration: none;
            display: inline-block;
            margin-top: 40px;
        }

        .hero-btn:hover {
            background-color: #2A4365;
            color: white;
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
                <a href="noacchome.php">Menu</a>
                <a href="login.php">Log-in</a>
                <input type="button" id="btn" value="Create an Account" onclick="window.location.href='createacc.php';">
            </div>
        </div>
    </div>

    
    <div class="hero-section">
        <div class="hero-text-container text-start">
            <h1 class="fw-bold hero-title mb-5">Make every taste count.</h1>
            <a href="noacchome.php" class="btn hero-btn">Order Now</a>
        </div>
    </div>



</body>
<script src="js/bootstrap.bundle.min.js"></script>
</html>

<?php


?>