<?php
require_once '../../db_ohayo_conn.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../font-family.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    img {
        object-fit: cover;
    }

    body {
        font-family: "New York Medium Regular";
    }

    #logs {
        background-color: #eee8e0;
    }

    #logs-content {
        height: 100%;
        background-color: #eee8e0;
    }

    .logs-content-title {
        font-family: "New York Large Bold";
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

    .logo-img {
        height: 100px;
        width: auto;
    }
</style>

<?php
$showlogs = "SELECT * FROM tb_logs ORDER BY datetime";
$reslogs = $conn->query($showlogs);

?>

<body class="text-dark">

    <div class="container-navbar">
        <div class="navbar">
            <div class="logo">
                <img src="images/logo.png" alt="Ohayo Brew Logo" style="width: 200px; height: auto; margin-left: 50px;">
            </div>

            <div class="navbar-right">
                <div class="profile-icon">
                    <a href="settings_customer/custoaccount.php"><img src="images/user.png" alt="Profile"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row ">
                        <h2>Hello, Admin!</h2>
                    </div>
                    <div class="row text-center p-4 my-4">
                        <h5><a href="admindash.php" class="link-underline link-underline-opacity-0 text-dark">Order
                                List</a></h5>
                    </div>
                    <div class="row text-center p-4 my-4">
                        <h5><a href="products.php" class="link-underline link-underline-opacity-0 text-dark">Products
                                List</a></h5>
                    </div>
                    <div class="row text-center  rounded-4  p-4 my-4 " id="logs">
                        <h5>Logs</h5>
                    </div>
                    <div class="row text-center p-4 my-4">
                        <h5>&nbsp</h5>
                    </div>
                    <div class="row text-center p-4 my-4">
                        <h5>&nbsp</h5>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="container rounded-4 " id="logs-content">
                    <div class="row p-3 logs-content-title">
                        <h4>Logs</h4>
                    </div>
                    <form action="logs.php" method="post">
                        <div class="row p-3">
                            <div class="col-10">
                                <input type="search" name="searchinput" placeholder="Search" class="form-control">
                            </div>
                            <div class="col">
                                <input type="submit" name="btnsearch" value="Search" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST["btnsearch"])) {
                        $search_ac = isset($_POST["searchinput"]) ? $_POST["searchinput"] : '';
                        $showlogs = " ";
                        if ($search_ac != NULL) {
                            $showlogs = "SELECT * FROM tb_logs WHERE user_id IN (SELECT user_id FROM tb_user WHERE username LIKE '$search_ac%')";
                        } else {
                            $showlogs = "SELECT * FROM tb_logs";
                        }
                        $reslogs = $conn->query($showlogs);
                    } else {
                        $showlogs = "SELECT * FROM tb_logs";
                        $reslogs = $conn->query($showlogs);

                    }

                    if ($reslogs && $reslogs->num_rows > 0) { ?>
                        <?php foreach ($reslogs as $log) { ?>
                            <div class="row bg-white rounded border mx-3 my-2 px-3 py-2 logs-content-title">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <p><?php $logname = "SELECT * FROM tb_user WHERE user_id = " . $log['user_id'];
                                            $logname_result = $conn->query($logname);
                                            echo $logname_result->fetch_assoc()['username']; ?>
                                            </p>
                                        </div>
                                        <div class="col text-end">
                                            <p><?php echo $log['datetime']; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p><?php echo $log['action']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else {
                        echo "<div class='row mx-3 my-2'><div class='col'>No record found</div></div>";
                    } ?>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>