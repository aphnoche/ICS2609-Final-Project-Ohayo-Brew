<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Settings - Terms of Service</title>
    <link rel="stylesheet" href="../font-family.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    img {
        object-fit: cover;
    }

    body {
        font-family: "New York Medium Regular", Georgia, serif;
    }

    #orders {
        background-color: #eee8e0;
    }

    #orders-content {
        height: 100%;
        background-color: #eee8e0;
    }

    #orders-content-title {
        font-family: "New York Large Bold", Georgia, serif;
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

    /* Custom scroll view utility for the Terms window */
    .tos-scrollview {
        max-height: 400px;
        overflow-y: auto;
        font-family: sans-serif;
        font-size: 14px;
        line-height: 1.6;
        color: #4A4A4A;
    }

    .tos-section-title {
        font-family: "New York Medium Regular", Georgia, serif;
        font-weight: bold;
        color: #2B323A;
        margin-top: 20px;
        margin-bottom: 8px;
    }
</style>

<body class="text-dark">
    <div class="header-bar d-flex justify-content-between align-items-center">
        <div>
            <img src="../images/logo.png" alt="Ohayo Brew" class="logo-img">
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
                    <div class="row text-center p-4 my-3">
                        <h5><a href="customyorder.php" class="link-underline link-underline-opacity-0 text-dark">My
                                Order</a></h5>
                    </div>
                    <div class="row text-center p-4 my-3">
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
                    <div class="row text-center rounded-4 p-4 my-3" id="orders">
                        <h5><a href="custoTOS.php" class="link-underline link-underline-opacity-0 text-dark">Terms of
                                Service</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="container rounded-4 pb-3" id="orders-content">
                    <div class="row p-3" id="orders-content-title">
                        <h4>Terms of Service</h4>
                    </div>
                    <div class="row bg-white rounded border mx-3 my-2 px-3 py-3">
                        <div class="container tos-scrollview">

                            <p class="text-muted small">Last Updated: May 2026</p>
                            <p>Welcome to <strong>Ohayo Brew</strong>. By creating an account, accessing our system, or
                                completing an order on our platform, you acknowledge that you have read, understood, and
                                agreed to be bound by the following operational guidelines and terms of service.</p>

                            <hr>

                            <div class="tos-section-title">1. Account Registration & Safety</div>
                            <p>Customers are required to provide authentic information including accurate name mappings,
                                local addresses, and active contact numbers. You remain exclusively responsible for
                                keeping your credentials confidential under your Profile Settings panel.</p>

                            <div class="tos-section-title">2. Menu Configurations & Add-ons</div>
                            <p>Ohayo Brew provides custom variables for menu items including temperature selections
                                (Hot/Iced), product measurements (Regular/Large), and specialized modifiers (Add-ons).
                                It is the responsibility of the customer to review these selections prior to choosing
                                "Buy Now" or "Add to Cart".</p>

                            <div class="tos-section-title">3. Pricing Metrics and Adjustments</div>
                            <p>All items listed on the dashboard are evaluated in Philippine Pesos (₱). Ohayo Brew
                                maintains the operational discretion to update or re-tariff item values dynamically
                                without direct prior warning. Confirmed order receipts lock in values instantly.</p>

                            <div class="tos-section-title">4. Payment Methods & Processing Security</div>
                            <p>Fulfillment occurs strictly upon authorized payments via supported gateways (such as
                                GCash transfers). If a transaction fails or displays fraudulent indicators, Ohayo Brew
                                holds the systemic authority to automatically toggle the tracking criteria status to
                                cancelled.</p>

                            <div class="tos-section-title">5. Perishable Good & Fulfillment Policies</div>
                            <p>Because all freshly brewed beverages and goods are explicitly perishable, orders that
                                progress out of 'Pending' statuses into 'Processing' environments cannot be cancelled,
                                returned, or exchanged. Refunds will only be evaluated if item drop-offs deviate
                                entirely from verified purchase receipts.</p>

                            <div class="tos-section-title">6. Framework Modifications</div>
                            <p>We reserve the right to revise these terms of usage metrics at any given timestamp.
                                Continued usage of our web terminal following adjustments registers as standard legal
                                validation of those changes.</p>

                            <p class="mt-4 text-center text-muted small">Thank you for brewing with Ohayo Brew!</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>