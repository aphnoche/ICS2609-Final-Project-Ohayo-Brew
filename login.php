<?php
    ob_start();
    session_start();
    require_once 'db_ohayo_conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in to your account - Ohayo Brew</title>
    <link rel="stylesheet" href="font-family.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


        /* Navbar Section */
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

        /* Login on the Left Section */    
        .login-section {
            flex: 1; 
            display: flex;
            align-items: center;
            margin-top: -50px;
        }

        .login-text-container {
            margin-left: 150px;   
            width: 100%;
            max-width: 520px;
        }

        .back-btn { /*Forda back button on the left*/ 
            display: inline-block;
            font-size: 40px;
            color: #333;
            text-decoration: none;
        }

        .login-title {
            font-family: 'New York Large Bold', serif;
            color: #2D3748; 
            font-size: 3.8rem;
            font-weight: bold;
            margin-bottom: 20px;
            margin-left: 75px;
        }

        .custom-form-group {            /*div for the input*/
            margin-bottom: 15px;
            margin-left: 75px;
        }

        .custom-input {                 /*mismong design of the input*/
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

        .custom-input::placeholder {    /*the text inside the input text*/
            color: #999;
        }

        .custom-input:focus {           /*pag-click, this happens*/
            border-color: #1A365D;
            box-shadow: 0 0 0 3px rgba(26, 54, 93, 0.1);
        }

        .signup-text {
            font-family: 'New York Medium Regular', sans-serif;
            font-size: 18px;
            color: #4A5568;
            margin-top: 25px;
            margin-bottom: 35px;
            margin-left: 75px;
        }

        .signup-text a {
            color: #2D3748;
            text-decoration: underline;
            font-weight: 600;
        }


        /*login button*/
        .login-btn {
            background-color: #1A365D;
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'New York Medium Regular', sans-serif;
            font-style: italic;
            padding: 14px 50px; 
            font-size: 20px;  
            cursor: pointer;
            transition: background-color 0.2s;
            margin-left: 85px;
        }

        .login-btn:hover {
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
                <input type="button" id="btn" value="Open Menu" onclick="window.location.href='noacchome.php';">
            </div>
        </div>
    </div>

    
    <div class="login-section">
        <div class="login-text-container text-start">
            
            <a href="landing.php" class="back-btn">&#8592;</a>

            <h2 class="login-title">Log-in to your account</h2>

            <form action="login.php" method="post">
                
                <div class="row custom-form-group">
                    <div class="col">
                        <input type="text" class="custom-input" name="username" placeholder="Username" required>
                    </div>
                </div>
                
                <div class="row custom-form-group">
                    <div class="col">
                        <input type="password" class="custom-input" name="password" placeholder="Password" required>
                    </div>
                </div>
                
                <div class="row signup-text">
                    <div class="col">
                        <p class="m-0">Don’t have an account? <a href="createacc.php">Create an account</a></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" name="sub" class="login-btn" value="Log-in">
                    </div>
                </div>
                
            </form>
        </div>
    </div>

</body>
<script src="js/bootstrap.bundle.min.js"></script>
</html>

<?php

    if(isset($_POST['sub'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login_sql = "SELECT * FROM tb_user WHERE username='$username' AND password='$password'";
        $login_result = $conn->query($login_sql);
        if($login_result->num_rows == 1) {
            $user_data = $login_result->fetch_assoc();
            $user_id = $user_data['user_id'];
            $user_username = $user_data['username'];
            $user_role = $user_data['role'];

            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $user_username;
            $_SESSION['role'] = $user_role;

            if($user_role == 'admin') {
                header("Location: dashboards/admin/adminhome.php");
                exit();
            } elseif($user_role == 'employee') {
                header("Location: dashboards/employee/employeehome.php");
                exit();
            } else {
                header("Location: home.php");
                exit();
            }
        } else {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed!',
                    text: 'Invalid username or password. Please try again.',
                    confirmButtonText: 'OK'
                });
            </script>
            ";
        }


    }

    ob_end_flush();

?>