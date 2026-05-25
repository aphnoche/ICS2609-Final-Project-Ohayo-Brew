<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almost there!</title>
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
            border: 3px solid #333;
            border-radius: 10px;
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
            width: 100%;
            max-width: 650px; 
        }

        .form-title {
            font-family: 'New York Large Bold', serif;
            color: #2D3748; 
            font-size: 3.2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-subtitle {
            font-family: 'New York Medium Regular', sans-serif;
            font-size: 19px;
            color: #555;
            margin-bottom: 35px;
        }

        .custom-form-group {
            margin-bottom: 50px;
        }

        .custom-input {
            width: 100%;
            padding: 16px 25px;
            font-family: 'New York Medium Regular', sans-serif;
            font-size: 20px;
            border: 1px solid #ccc;
            border-radius: 15px; 
            background-color: #fff;
            outline: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.03);
            transition: all 0.2s ease-in-out;
        }

        .custom-input::placeholder {
            color: #999;
        }

        .custom-input:focus {
            border-color: #1A365D;
            box-shadow: 0 0 0 3px rgba(26, 54, 93, 0.1);
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 30px;
            margin-bottom: 35px;
        }

        .custom-checkbox {
            width: 28px;
            height: 28px;
            cursor: pointer;
            border-radius: 6px; 
            accent-color: #1A365D; 
        }

        .checkbox-label {
            font-family: 'New York Medium Regular', sans-serif;
            font-size: 20px;
            color: #333;
            cursor: pointer;
            user-select: none;
        }

        .hero-btn {
            background-color: #1A365D;
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'New York Medium Regular', sans-serif;
            font-style: italic;
            padding: 14px 50px; 
            font-size: 24px;  
            cursor: pointer;
            transition: background-color 0.2s;
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
                <input type="button" id="btn" value="Order Now" onclick="window.location.href='noacchome.php';">
            </div>
        </div>
    </div>

    <div class="hero-section">
        <div class="hero-text-container text-start">
            
            <h2 class="form-title">Verify your email</h2>
            <p class="form-subtitle">We sent an email in your inbox. Please check your spam folder if you don't see it.</p>

            <form action="register_process.php" method="post">
                
                <div class="row g-3 custom-form-group">
                    <div class="col-md-6">
                        <input type="text" class="custom-input" name="otp" placeholder="One-time Password" required>
                    </div>
                </div>

                <input type="submit" class="hero-btn" value="Verify">
                
            </form>
        </div>
    </div>

</body>
<script src="js/bootstrap.bundle.min.js"></script>
</html>

<?php
    require_once 'db_ohayo_conn.php';

    if(isset($_POST['ver'])){
        //user input
        $an_userotp = $_POST['otp'];

        $an_otpsql = "SELECT * FROM tbl_userdetails_ahn WHERE otp = '$an_userotp'";
        $an_otpresult = $conn->query($an_otpsql);
    
        if ($an_otpresult->num_rows == 1) {
            $an_otpverifysql = "UPDATE tbl_userdetails_ahn SET otp = NULL, otp_status = 'Active' WHERE otp = '$an_userotp'";
            $conn->query($an_otpverifysql);

            ?>
            <script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "OTP Verified Successfully.",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = "login.php";
                });
            </script>
            <?php
        } else {
            ?>
            <script>
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Invalid OTP.",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
            <?php
        }
                
        
    }

?>