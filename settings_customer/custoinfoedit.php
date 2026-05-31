<?php
session_start();
require_once '../db_ohayo_conn.php'; // Includes your database connection

// Fetch current user ID from session, default to 1 for testing
$user_id = $_SESSION['user_id'] ?? 1;

// Tracking variables for SweetAlert states
$alert_status = "";
$error_message = "";

// --- STEP 1: HANDLE THE COMPLETED FORM SUBMISSION (UPDATE DB) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply_changes'])) {
    // Advanced escape functions REMOVED - direct assignment from $_POST
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact_number'];
    $email = $_POST['email_address'];

    $update_sql = "UPDATE tb_user SET 
                    first_name = '$first_name', 
                    last_name = '$last_name', 
                    address = '$address', 
                    contact_no = '$contact', 
                    email = '$email' 
                  WHERE user_id = $user_id";

    $update_result = $conn->query($update_sql);

    if ($update_result == TRUE) {
        $alert_status = "success";
    } else {
        $alert_status = "error";
        $error_message = mysqli_error($conn);
    }
}

// --- STEP 2: FETCH CURRENT USER DETAILS TO PRE-FILL INPUT FIELDS ---
$user_sql = "SELECT * FROM tb_user WHERE user_id = $user_id";
$user_result = mysqli_query($conn, $user_sql);
$user_data = [];

if ($user_result && mysqli_num_rows($user_result) > 0) {
    $user_data = mysqli_fetch_assoc($user_result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Customer Information</title>
    <link rel="stylesheet" href="../font-family.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #ffffff;
            font-family: "New York Medium Regular";
        }

        .header-bar {
            background-color: #ffffff;
            padding: 16px 40px;
            border-bottom: none;
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

        .btn-add-info {
            background-color: #a07840;
            color: #ffffff;
            border-radius: 10px;
            font-size: 15px;
            padding: 10px 22px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: "New York Medium Regular";
            margin-bottom: 20px;
        }

        .btn-add-info:hover {
            background-color: #8b6530;
            color: #ffffff;
        }

        .edit-card-heading {
            font-size: 17px;
            font-weight: 600;
            color: #2b2b2b;
            margin-bottom: 22px;
        }

        .form-container-wrapper {
            width: 65%;
        }

        .form-control-custom {
            background-color: #ffffff;
            border: 1.5px solid #c8c0b4;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 15px;
            color: #2b2b2b;
            font-family: Georgia, 'Times New Roman', serif;
            width: 100%;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control-custom::placeholder {
            color: #9e9488;
        }

        .form-control-custom:focus {
            border-color: #a07840;
            box-shadow: none;
        }

        .btn-apply {
            background-color: #a07840;
            color: #ffffff;
            border-radius: 10px;
            font-size: 15px;
            padding: 11px 32px;
            border: none;
            font-family: "New York Medium Regular";
        }

        .btn-apply:hover {
            background-color: #8b6530;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="header-bar d-flex justify-content-between align-items-center">
        <div>
            <img src="../images/logo.png" alt="Ohayo Brew Logo" class="logo-img">
        </div>
        <div class="profile-icon">
            <img src="../images/user.png" alt="Profile">
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="container">
                    <div class="row">
                        <h2><b>Settings</b></h2>
                    </div>
                    <div class="row text-center rounded-4 p-4 my-3">
                        <h5><a href="customyorder.php" class="link-underline link-underline-opacity-0 text-dark">My
                                Order</a></h5>
                    </div>
                    <div class="row text-center p-4 my-3">
                        <h5><a href="custoaccount.php"
                                class="link-underline link-underline-opacity-0 text-dark">Accounts</a></h5>
                    </div>
                    <div class="row text-center p-4 my-3 rounded-4" id="orders">
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

            <div class="col-md-9">
                <div class="container rounded-4" id="orders-content">
                    <div class="row pt-4 px-4" id="orders-content-title">
                        <div class="col-9">
                            <h1>Customer Information</h1>
                        </div>
                        <div class="col pt-3 text-end">
                        </div>
                    </div>

                    <div class="row bg-white rounded mx-5 mb-5 px-3 py-3">
                        <div class="container pb-5">
                            <div class="row">
                                <div class="col">
                                    <div class="edit-card-heading">Edit Information</div>
                                </div>
                            </div>

                            <form method="POST" action="" class="row g-3 form-container-wrapper mx-auto">
                                <div class="col-md-6">
                                    <input type="text" name="first_name" class="form-control-custom"
                                        placeholder="First Name" value="<?php echo $user_data['first_name'] ?? ''; ?>">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="last_name" class="form-control-custom"
                                        placeholder="Last Name" value="<?php echo $user_data['last_name'] ?? ''; ?>">
                                </div>
                                <div class="col-12">
                                    <input type="text" name="address" class="form-control-custom" placeholder="Address"
                                        value="<?php echo $user_data['address'] ?? ''; ?>">
                                </div>
                                <div class="col-12">
                                    <input type="text" name="contact_number" class="form-control-custom"
                                        placeholder="Contact Number"
                                        value="<?php echo $user_data['contact_number'] ?? ''; ?>">
                                </div>
                                <div class="col-12">
                                    <input type="email" name="email_address" class="form-control-custom"
                                        placeholder="Email Address" value="<?php echo $user_data['email'] ?? ''; ?>">
                                </div>
                                <div class="col-12 d-flex justify-content-center mt-4">
                                    <button type="submit" name="apply_changes" class="btn-apply">Apply Changes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <?php if ($alert_status === "success"): ?>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Changes applied successfully!',
                icon: 'success',
                confirmButtonColor: '#a07840'
            }).then(function () {
                // Redirects back to custoinfo.php upon clicking OK
                window.location.href = 'custoinfo.php';
            });
        </script>
    <?php elseif ($alert_status === "error"): ?>
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Failed to update information: <?php echo $error_message; ?>',
                icon: 'error',
                confirmButtonColor: '#a07840'
            });
        </script>
    <?php endif; ?>

</body>

</html>