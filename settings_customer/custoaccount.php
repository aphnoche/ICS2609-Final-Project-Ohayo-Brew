<?php
require_once '../db_ohayo_conn.php';
session_start();

// Fetch current user ID from session (default to 1 for testing purposes)
$user_id = $_SESSION['user_id'] ?? 1;

// Tracking variables for SweetAlert states
$alert_status = "";
$alert_message = "";

// --- HANDLE FORM SUBMISSION ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply_changes'])) {

    // 1. Fetch current database record for password verification
    $query = "SELECT * FROM tb_user WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // 2. Grab inputs directly from POST (No advanced functions)
    $new_username = $_POST['new_username'];
    $current_password_username = $_POST['current_password_username'];

    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $error_occurred = false;
    $changes_made = false;

    // --- CASE A: USER WANTS TO CHANGE THEIR USERNAME ---
    if (!empty($new_username)) {
        // MD5 hash the user's input so it accurately matches the database hash format
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

    // --- CASE B: USER WANTS TO CHANGE THEIR PASSWORD ---
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
    <title>Customer Settings</title>
    <link rel="stylesheet" href="../font-family.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 CDN Library Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    img {
        object-fit: cover;
    }

    body {
        font-family: "New York Medium Regular";
    }

    #orders {
        background-color: #eee8e0;
    }

    #orders-content {
        height: 100%;
        background-color: #eee8e0;
    }

    #orders-content-title {
        font-family: "New York Large Bold";
    }

    .header-bar {
        background-color: #ffffff;
        padding: 16px 40px;
    }

    .logo-img {
        height: 100px;
        width: auto;
    }

    .profile-icon {
        width: 52px;
        height: 52px;
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
        text-decoration: none;
    }
</style>

<body class="text-dark">
    <div class="header-bar d-flex justify-content-between align-items-center">
        <div>
            <img src="../images/logo.png" alt="" class="logo-img">
        </div>
        <div class="profile-icon">
            <img src="../images/user.png" alt="Profile">
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Sidebar Selection Menu -->
            <div class="col-md-3">
                <div class="container">
                    <div class="row ">
                        <h2><b>Settings</b></h2>
                    </div>
                    <div class="row text-center p-4 my-3">
                        <h5><a href="customyorder.php" class="link-underline link-underline-opacity-0 text-dark">My
                                Order</a></h5>
                    </div>
                    <div class="row text-center rounded-4 p-4 my-3" id="orders">
                        <h5><a href="custoaccount.php"
                                class="link-underline link-underline-opacity-0 text-dark">Accounts</a></h5>
                    </div>
                    <div class="row text-center p-4 my-3">
                        <h5><a href="custoinfo.php" class="link-underline link-underline-opacity-0 text-dark">Customer
                                Information</a></h5>
                    </div>
                    <div class="row text-center p-4 my-3">
                        <h5><a href="custopayment.php" class="link-underline link-underline-opacity-0 text-dark">Payment
                                Method</a></h5>
                    </div>
                    <div class="row text-center p-4 my-3">
                        <h5><a href="custoTOS.php" class="link-underline link-underline-opacity-0 text-dark">Terms of
                                Service</a></h5>
                    </div>
                </div>
            </div>

            <!-- Main Interactive Account Panel Column -->
            <div class="col-md-9">
                <div class="container rounded-4" id="orders-content">
                    <div class="account-panel">
                        <div class="account-title">Manage Account</div>

                        <!-- Form wrapper mapped directly with layout inputs -->
                        <form method="POST" action="">
                            <div class="row">
                                <!-- Change Username side -->
                                <div class="col-6">
                                    <div class="col-section-title">Change Username</div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <input type="text" name="new_username" placeholder="Username"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <input type="password" name="current_password_username"
                                                placeholder="Password" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <!-- Change Password side -->
                                <div class="col-6">
                                    <div class="col-section-title">Change Password</div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <input type="password" name="current_password"
                                                placeholder="Current Password" class="form-control">
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
                                            <input type="password" name="confirm_password"
                                                placeholder="Confirm Password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row mt-3">
                                <div class="col d-flex justify-content-center">
                                    <button type="submit" name="apply_changes" class="btn-gold-lg">Apply
                                        Changes</button>
                                </div>
                            </div>
                        </form>

                        <div class="logout-banner">
                            <div class="logout-text">Want to log-out of the account?</div>
                            <a href="../login.php" class="btn-logout text-center">Log-out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert Interactive Dynamic Script Output -->
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