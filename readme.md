## Ohayo Brew ☕
### Full-Stack Coffee Shop Management & Ordering System

Ohayo Brew is a web-based point-of-sale (POS) and interactive customer ordering application built tailored for a specialty coffee shop. Designed using a classic monolithic architecture with **procedural PHP**, **MySQLi**, and styled elegantly with **Bootstrap 5.3** and **SweetAlert2**, the platform balances a user-friendly custom ordering portal with strict administrative oversight tools.

---

## 🌟 Core System Features

### 1. Customer-Facing Ordering Experience
* **Interactive Menu & Catalog:** Dynamic catalog pulling directly from the database schema.
* **Granular Drink Modifiers:** Multi-dimensional variant selection covering Temperature configurations (`Hot` or `Iced`) and Dimensional Scaling (`Regular` or `Large`).
* **Relational Add-ons Engine:** Interactive checkboxes linked dynamically to a modifiers table (`tb_addon`), automatically tabulating running upcharges.
* **Pristine Mathematics Tally Engine:** Client-side JavaScript system seamlessly coordinating unit multipliers (Quantity selectors) alongside base costs and addon upcharges to render true pricing flags prior to payload submissions.
* **Shopping Cart Architecture:** Robust, multi-item relational session persistence layer (`$_SESSION['cart']`) that maps product instances, customized variants, specific item notes, and linked arrays of chosen addon IDs seamlessly.
* **Checkout & Finalization Matrix:** Two-tier order validation sequence pipeline tracking structural data across relational master/child database schemas (`tb_order`, `tb_order_item`, `tb_order_item_addon`).

### 2. Administrative Control Center
* **Inventory Master Management:** Full Create, Read, Update, Delete (CRUD) mechanics over shop commodities with contextual multi-part handling supporting secure system file system uploads for menu items.
* **Live Order Processing Center:** Consolidated order processing stream dividing data sets transparently between open fulfillment streams (`Processing`) and persistent accounting buckets (`Completed`).
* **Granular Modification History Logs:** Comprehensive, real-time security tracking monitoring action histories. Automated log execution capturing background changes, associating actions to an active admin user identity profile with historical date/time tracking.

### 3. Employee Service Panel
* **Fulfillment Dashboard:** Stripped down, focused service pipeline built for speed. Allows floor employees to view real-time incoming processing tickets and execute classic state transitions with single-click actions.
* **Product Availability Matrices:** Live toggles enabling floor workers to manipulate operational state statuses when stock shortages emerge.

---

## 🏗️ Architectural Framework & Data Structure

### System Pipeline Safeguards
1. **Special Character Escaping:** Manual structural security protocols implemented using string sanitization wrappers (`mysqli_real_escape_string`) on incoming variable fields, preventing string breakdowns caused by special characters like punctuation or apostrophes (e.g., *Ohayo's Matcha*).
2. **Output Stream Control:** Embedded runtime execution isolation layers running native buffering techniques (`ob_start()`) at script configurations to capture server payloads cleanly and eliminate immediate redirect faults.

### 💾 Relational Database Schema Mapping

The core environment functions relative to a highly relational database schema ensuring deep data consistency across tables:

              +------------------+
              |     tb_user      |
              +------------------+
                       | (1)
                       |
                       | (N)
              +------------------+
              |     tb_order     |
              +------------------+
                       | (1)
                       |
                       | (N)
              +------------------+         +------------------+
              |  tb_order_item   |-------< |    tb_product    |
              +------------------+ (N) (1) +------------------+
                       | (1)                         | (1)
                       |                             |
                       | (N)                         | (N)
          +-----------------------+        +------------------+
          |  tb_order_item_addon  |        | tb_product_size  |
          +-----------------------+        +------------------+
                       | (N)
                       |
                       | (1)
              +------------------+
              |     tb_addon     |
              +------------------+

* `tb_user`: Manages client profiles, addresses, authentication states, and system authorizations (`user_id`, `first_name`, `last_name`, `address`, `contact_no`, `username`).
* `tb_product`: Base menu definitions tracking main identity keys (`product_id`, `product_name`, `description`, `image`).
* `tb_product_size`: Relational cost scaling matrix defining multi-price listings for sizes (`product_id`, `size_name`, `price`).
* `tb_addon`: Master registry of independent drink additions (`addon_id`, `addon_name`, `addon_price`).
* `tb_order`: Core master transaction logs (`order_id`, `user_id`, `order_date`, `total_price`, `order_status` ['Pending', 'Processing', 'Completed']).
* `tb_order_item`: Relational child structural layer mapping transactional metrics inside individual order IDs (`order_item_id`, `order_id`, `product_id`, `quantity`, `item_price`).
* `tb_order_item_addon`: Relational link mapping many-to-many options checked per purchased line item (`order_item_id`, `addon_id`).
* `tb_logs`: System diagnostic history trail tracking administrative CRUD operations securely (`log_id`, `user_id`, `action`, `datetime`).

---

## 📂 System Directory Layout

ICS2609-Final-Project-Ohayo-Brew/
│
├── db_ohayo_conn.php          # Shared core procedural database wrapper object
├── font-family.css            # Central typographic typography configuration mappings
├── landing.php                # MANDATORY INITIAL ENTRY POINT
├── home.php                   # Core customer facing marketplace layout matrix
├── product.php                # Customizer console handling variants and upcharges
├── checkout.php               # Session shopping cart parser & relational mapper
├── purchase.php               # Transaction terminal displaying payment configurations
├── complete_purchase.php      # Success splash final destination page
│
├── css/
│   └── bootstrap.min.css      # Core grid styling foundations
├── js/
│   └── bootstrap.bundle.min.js# Core client interaction systems
│
├── images/                    # Structural UI vector design elements & root image bank
│   ├── logo.png
│   ├── user.png
│   └── checkout.png
│
└── dashboards/
    ├── admin/                 # Restricted Administrative Ecosystem Panels
    │   ├── admindash.php      # Live transaction monitoring panel
    │   ├── products.php       # Product catalogue operations center
    │   ├── editproduct.php    # Clean multi-part CRUD image file processor
    │   ├── logs.php           # Scrollable system action audit stream
    │   └── images/            # Isolated folder storing administrative uploads
    │
    └── employee/              # Floor Personnel Operational Panels
        ├── employeedash.php   # Fulfillment tracking view board
        └── products.php       # Real-time stock status switcher

## 🛠️ Complete Installation & Local Server Setup
**Follow these step-by-step instructions to deploy the Ohayo Brew application stack in your local development environment using standard tools like XAMPP or WAMP.**

1. **File Placement Configuration**
Download or clone this project repository.
Extract and move the entire project folder into your local web server's root directory. Ensure the path looks like this:
For XAMPP (Windows): C:\xampp\htdocs\ICS2609-Final-Project-Ohayo-Brew\
For WAMP (Windows): C:\wamp\www\ICS2609-Final-Project-Ohayo-Brew\

2. **Initialize the Local Servers**
Open your local server management panel (e.g., XAMPP Control Panel).
Start both the Apache (HTTP Server) module and the MySQL (Database Server) module.

3. **Database Schema Creation & SQL Import**
Open your web browser and navigate to the database management tool: **http://localhost/phpmyadmin/**
Click on New in the left sidebar to create a fresh database.
Name the database exactly: ohayo_brew (all lowercase, matching the connection scripts).
Click on your newly created ohayo_brew database from the sidebar, then click the Import tab at the top menu.
Click Choose File and navigate to your project's root folder to select the provided backup database file (e.g., ohayo_brew.sql).
Scroll to the bottom of the page and click Import. This will automatically build all necessary tables (tb_user, tb_product, tb_order, etc.) and load the initial coffee menu items.

4. **Verify Database Connection Credentials**
Open the db_ohayo_conn.php file located at the root directory of the project in your code/text editor.
Double-check that the connection settings match your local server environment default configurations:
        $servername = "localhost";
        $username = "root";       
        $password = "";           
        $dbname = "db_ohayo";   

## 🎮 How to Launch and Test
**⚠️ CRITICAL STARTUP REQUIREMENT:** To ensure the system handles session tokens, user login statuses, and cart data correctly without encountering errors, you must enter the web application exclusively through the system's designated entrance file.
Open your internet browser application and type the following URL directly into the address bar: http://localhost/ICS2609-Final-Project-Ohayo-Brew/landing.php

## System Traversal Roadmap:
**The Entry Portal (landing.php)**: Initializes global configurations and gives you options to enter as a Customer or access administrative areas.

**Customer Portal**: Register a new user account, browse the menu (home.php), customize drinks with add-ons (product.php), view your cart (checkout.php), and complete a checkout transaction.

**Admin/Employee Dashboards**: Navigate to the dashboard directory (dashboards/admin/admindash.php or dashboards/employee/employeedash.php) to view processing orders, mark pending orders as Completed, toggle product availability, or check the automated security history logs tracking system activities!