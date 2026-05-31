<?php
session_start();
require_once 'db_ohayo_conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your account - Ohayo Brew</title>
    <link rel="stylesheet" href="font-family.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html,
        body {
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

        .signup-section {
            flex: 1;
            display: flex;
            align-items: center;
            margin-top: -50px;
        }

        .signup-text-container {
            margin-left: 150px;
            width: 100%;
            max-width: 500px;
        }

        .back-btn {
            display: inline-block;
            font-size: 40px;
            color: #333;
            text-decoration: none;
        }

        .login-title {
            font-family: 'New York Large Bold', serif;
            color: #2D3748;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            margin-left: 80px;
        }

        .custom-form-group {
            margin-bottom: 25px;
            margin-left: 75px;
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
            transition: all 0.2s ease-in-out;
        }

        .custom-input::placeholder {
            color: #999;
        }

        .custom-input:focus {
            border-color: #1A365D;
            box-shadow: 0 0 0 3px rgba(26, 54, 93, 0.1);
        }

        .signup-text {
            font-family: 'New York Medium Regular', sans-serif;
            font-size: 18px;
            color: #4A5568;
            margin-top: 25px;
            margin-bottom: 35px;
            margin-left: 85px;
        }

        .signup-text a {
            color: #2D3748;
            text-decoration: underline;
            font-weight: 600;
        }

        .signup-btn {
            background-color: #1A365D;
            color: white;
            border: none;
            border-radius: 12px;
            font-family: 'New York Medium Regular', sans-serif;
            padding: 14px 50px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-left: 90px;
        }

        .signup-btn:hover {
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

    <div class="signup-section">
        <div class="signup-text-container text-start">

            <a href="landing.php" class="back-btn">&#8592;</a>

            <h2 class="login-title">Create your account</h2>

            <form action="createacc.php" method="post">

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

                <div class="row custom-form-group">
                    <div class="col">
                        <input type="password" class="custom-input" name="confirm_password"
                            placeholder="Confirm Password" required>
                    </div>
                </div>

                <div class="row signup-text">
                    <div class="col">
                        <p class="m-0">Log-in <a href="login.php">here</a> if you already have an account.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" name="sub" class="signup-btn" value="Create Account">
                    </div>
                </div>

            </form>
        </div>
    </div>

</body>
<script src="js/bootstrap.bundle.min.js"></script>

</html>

<?php
if (isset($_POST['sub'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Passwords do not match. Please try again.'
                });
            </script>
            ";
    } else {
        $insert_sql = "INSERT INTO tb_user (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $insert_sql)) {

            // SAVE THE ASSIGNED USER ID INTO THE SESSION HOOK
            $_SESSION["user_id"] = mysqli_insert_id($conn);

            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Account created successfully. Please provide your profile details next.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'createdeets.php';
                    });
                </script>
                ";
        } else {
            echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'There was an error creating your account. Please try again.',
                        footer: '" . mysqli_error($conn) . "'
                    });
                </script>";
        }
    }
}
?>