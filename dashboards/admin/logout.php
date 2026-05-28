<?php
require_once '../../db_ohayo_conn.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            margin: 30px auto;
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
        }
    </style>
</head>
<body>
    <div class="header-bar d-flex justify-content-between align-items-center">
        <div>
            <img src="../images/logo.png" alt="" class="logo-img">
        </div>
        <div class="profile-icon">
            <img src="" alt="">
        </div>
    </div>
    <div class="container">
        <div class="account-panel">
            <div class="account-title">Manage Account</div>
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
                            <input type="password" name="current_password_username" placeholder="Password" class="form-control">
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
                            <input type="password" name="current_password" placeholder="Current Password" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="password" name="new_password" placeholder="New Password" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col d-flex justify-content-center">
                    <div class="btn-gold-lg">Apply Changes</div>
                </div>
            </div>
            <div class="logout-banner">
                <div class="logout-text">Want to log-out of the account?</div>
                <div class="btn-logout">Log-out</div>
            </div>
        </div>
    </div>
</body>
</html>

