<?php
require_once '../../db_ohayo_conn.php';
session_start();

// Fetch current user ID from session (default to 1 for testing purposes)
$user_id = $_SESSION['user_id'] ?? 6;

// Tracking variables for SweetAlert states
$alert_status = "";
$alert_message = "";

// --- HANDLE FORM SUBMISSION ---
if (isset($_POST['apply_changes'])) {

    // 1. Fetch current database record for password verification
    $query = "SELECT * FROM tb_user WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // 2. Grab inputs directly from POST (No advanced sanitization functions)
    $new_username = $_POST['new_username'];
    $current_password_username = $_POST['current_password_username'];

    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $error_occurred = false;
    $changes_made = false;

    // --- CASE A: ADMIN WANTS TO CHANGE THEIR USERNAME ---
    if (!empty($new_username)) {
        // MD5 hash the user's input to accurately match the database hash format
        if (md5($current_password_username) === $user['password']) {
            $username_sql = "UPDATE tb_user SET username = '$new_username' WHERE user_id = $user_id";
            mysqli_query($conn, $username_sql);
            $changes_made = true;
        } else {
            $alert_status = "error";
            $alert_message = "Incorrect password entered for changing username!";
            $error_occurred = true;
        }
    }

    // --- CASE B: ADMIN WANTS TO CHANGE THEIR PASSWORD ---
    if (!empty($new_password) && !$error_occurred) {
        // MD5 hash the entered current password to verify against the stored hash
        if (md5($current_password) === $user['password']) {
            // Confirm new password values match up
            if ($new_password === $confirm_password) {
                // Hash the new password using MD5 before uploading it to the database
                $hashed_new_password = md5($new_password);
                $password_sql = "UPDATE tb_user SET password = '$hashed_new_password' WHERE user_id = $user_id";
                mysqli_query($conn, $password_sql);
                $changes_made = true;
            } else {
                $alert_status = "error";
                $alert_message = "New password and confirmation password do not match!";
                $error_occurred = true;
            }
        } else {
            $alert_status = "error";
            $alert_message = "Incorrect current password entered!";
            $error_occurred = true;
        }
    }

    // --- EVALUATE SUCCESS ALERTS ---
    if (!$error_occurred) {
        if ($changes_made) {
            $alert_status = "success";
            $alert_message = "Account changes applied successfully!";
        } else {
            $alert_status = "info";
            $alert_message = "No updates were requested. Fields left empty.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #ffffff;
            font-family: Georgia, 'Times New Roman', serif;
        }

        .header-bar {
            background-color: #ffffff;
            padding: 16px 40px;
        }

        .logo-img {
            height: 100px;
            width: auto;
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

        .account-panel {
            background-color: #ede8e0;
            border-radius: 16px;
            padding: 40px 50px;
            max-width: 900px;
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
        }

        .back-button {
            display: inline-block;
            margin-left: 50px;
            margin-top: 5px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #333333;
            font-size: 28px;
            transition: transform 0.2s ease;
        }

        .back-button:hover {
            transform: translateX(-5px);
            color: #000000;
        }

        .account-title {
            font-size: 30px;
            font-weight: 700;
            color: #2b2b2b;
            margin-bottom: 28px;
        }

        .col-section-title {
            font-size: 16px;
            color: #2b2b2b;
            margin-bottom: 12px;
        }

        .form-control {
            border: 1.5px solid #bbb;
            border-radius: 8px;
            font-size: 15px;
            font-family: Georgia, 'Times New Roman', serif;
            background-color: #ffffff;
        }

        .form-control:focus {
            border-color: #a07840;
            box-shadow: none;
        }

        .position-label {
            font-size: 15px;
            font-weight: 600;
            color: #2b2b2b;
            margin-top: 8px;
        }

        .btn-gold-lg {
            background-color: #a07840;
            color: #ffffff;
            border-radius: 24px;
            font-size: 16px;
            padding: 12px 40px;
            border: none;
            font-family: Georgia, 'Times New Roman', serif;
            cursor: pointer;
        }

        .logout-banner {
            background-color: #b89464;
            border-radius: 12px;
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 28px;
        }

        .logout-text {
            font-size: 16px;
            color: #f5f0e8;
            font-style: italic;
        }

        .btn-logout {
            background-color: #7a4f28;
            color: #ffffff;
            border-radius: 20px;
            font-size: 15px;
            padding: 10px 28px;
            border: none;
            font-family: Georgia, 'Times New Roman', serif;
            cursor: pointer;
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
                <div class="profile-icon">
                    <a href="logout.php"><img src="images/user.png" alt="Profile"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <a href="admindash.php" class="back-button">←</a>
        <div class="account-panel">

            <div class="account-title">Manage Account</div>

            <form method="POST" action="">
                <div class="row">
                    <div class="col-6">
                        <div class="col-section-title">Change Username</div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="new_username" placeholder="Username" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="password" name="current_password_username" placeholder="Password"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="position-label">Position: Admin</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="col-section-title">Change Password</div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="password" name="current_password" placeholder="Current Password"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="password" name="new_password" placeholder="New Password"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="password" name="confirm_password" placeholder="Confirm Password"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col d-flex justify-content-center">
                        <button type="submit" name="apply_changes" class="btn-gold-lg">Apply Changes</button>
                    </div>
                </div>
            </form>

            <div class="logout-banner">
                <div class="logout-text">Want to log-out of the account?</div>
                <div class="btn-logout" onclick="location.href='../../landing.php'">Log-out</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php if ($alert_status === "success"): ?>
        <script>
            Swal.fire({
                title: 'Success!',
                text: '<?php echo $alert_message; ?>',
                icon: 'success',
                confirmButtonColor: '#a07840'
            });
        </script>
    <?php elseif ($alert_status === "error"): ?>
        <script>
            Swal.fire({
                title: 'Error!',
                text: '<?php echo $alert_message; ?>',
                icon: 'error',
                confirmButtonColor: '#a07840'
            });
        </script>
    <?php elseif ($alert_status === "info"): ?>
        <script>
            Swal.fire({
                title: 'Info',
                text: '<?php echo $alert_message; ?>',
                icon: 'info',
                confirmButtonColor: '#a07840'
            });
        </script>
    <?php endif; ?>

</body>

</html>