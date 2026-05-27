<?php
    // RESUME THE SESSION TO READ THE ACCOUNT ID
    session_start();
    require_once 'db_ohayo_conn.php';

    // SECURITY CHECK: If someone manually types this URL without registering first, kick them back
    if (!isset($_SESSION['user_id'])) {
        header("Location: createacc.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almost there!</title>
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
            margin-top: -50px;
        }

        .back-btn {
            display: inline-block;
            font-size: 40px;
            color: #333;
            text-decoration: none;
        }

        .form-title {
            font-family: 'New York Large Bold', serif;
            color: #2D3748; 
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 5px;
            margin-left: 80px;
        }

        .form-subtitle {
            font-family: 'New York Medium Regular', sans-serif;
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
            margin-left: 80px;
        }

        .custom-form-group {
            margin-bottom: 22px;
        }

        .custom-input {
            width: 100%;
            padding: 16px 25px;
            font-family: 'New York Medium Regular', sans-serif;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 15px; 
            background-color: #fff;
            outline: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.03);
            transition: all 0.2s ease-in-out;
            margin-left: 85px;
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
            gap: 13px;
            margin-top: 20px;
            margin-bottom: 25px;
            margin-left: 85px;
        }

        .custom-checkbox {
            width: 25px;
            height: 25px;
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
            padding: 14px 50px; 
            font-size: 18px;  
            cursor: pointer;
            transition: background-color 0.2s;
            margin-left: 85px;
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

            <a href="landing.php" class="back-btn">&#8592;</a>
            
            <h2 class="form-title">Almost there!</h2>
            <p class="form-subtitle">Fill the necessary information to proceed with ordering.</p>

            <form action="createdeets.php" method="post">
                
                <div class="row g-3 custom-form-group">
                    <div class="col-md-6">
                        <input type="text" class="custom-input" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="custom-input" name="last_name" placeholder="Last Name" required>
                    </div>
                </div>
                
                <div class="custom-form-group">
                    <input type="text" class="custom-input" name="address" placeholder="Address" required>
                </div>
                
                <div class="custom-form-group">
                    <input type="text" class="custom-input" name="contact" placeholder="Contact Number" required>
                </div>

                <div class="custom-form-group">
                    <input type="email" class="custom-input" name="email" placeholder="Email Address" required>
                </div>
                
                <div class="checkbox-container">
                    <input type="checkbox" id="terms" name="terms" class="custom-checkbox" required>
                    <label for="terms" class="checkbox-label">I agree to the terms and conditions.</label>
                </div>

                <input type="submit" name="sub" class="hero-btn" value="Proceed">       
            </form>
        </div>
    </div>

</body>
<script src="js/bootstrap.bundle.min.js"></script>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sub'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        
        // Pull identity safely from current session hook
        $user_id = $_SESSION['user_id'];

        // FIXED: Table name changed to tb_user, query formatted properly to avoid syntax crash
        $update_recordsql = "UPDATE tb_user SET 
                             first_name='$first_name', 
                             last_name='$last_name', 
                             address='$address', 
                             contact='$contact', 
                             email='$email', 
                             otp_status='Pending' 
                             WHERE user_id='$user_id'";

        // EXECUTE QUERY USING MYSQLI_QUERY
        if(mysqli_query($conn, $update_recordsql)) {
            echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Complete!',
                    text: 'Your details have been securely recorded.',
                    confirmButtonText: 'Let\'s Go!'
                }).then(() => {
                    window.location.href = 'inputotp.php'; 
                });
            </script>
            ";
        } else {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Could not save profile details.',
                    footer: '".mysqli_error($conn)."'
                });
            </script>";
        }
    }
?>