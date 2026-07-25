<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include("../backend/connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Customer | BMS</title>

    <link rel="stylesheet" href="asset/css/addcustomer.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>



<div class="container">

    <!-- Sidebar -->

    <aside class="sidebar">

        <div class="logo">

            <i class="fa-solid fa-chart-line"></i>

            <h2>BMS</h2>

        </div>

        <ul>

            <li>
                <a href="index.php">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </li>

            <li class="active">
                <a href="customers.php">
                    <i class="fa-solid fa-users"></i>
                    Customers
                </a>
            </li>

            <li>
                <a href="products.php">
                    <i class="fa-solid fa-box"></i>
                    Products
                </a>
            </li>

            <li>
                <a href="suppliers.php">
                    <i class="fa-solid fa-truck"></i>
                    Suppliers
                </a>
            </li>

            <li>
                <a href="sales.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Purchases
                </a>
            </li>

            <li>
                <a href="sales.php">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    Sales
                </a>
            </li>

            <li>
                <a href="inventory.php">
                    <i class="fa-solid fa-warehouse"></i>
                    Inventory
                </a>
            </li>

            <li>
                <a href="employees.php">
                    <i class="fa-solid fa-user-tie"></i>
                    Employees
                </a>
            </li>

            <li>
                <a href="reports.php">
                    <i class="fa-solid fa-chart-column"></i>
                    Reports
                </a>
            </li>

            <li>
                <a href="settings.php">
                    <i class="fa-solid fa-gear"></i>
                    Settings
                </a>
            </li>

            <li>
                <a href="logout.php">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>
            </li>

        </ul>

    </aside>

    <!-- Main -->

    <main class="main">

        <!-- Topbar -->

        <header class="topbar">

            <h2>Add New Customer</h2>

           <div class="profile">


<img src="assets/images/admin.png">


<div>


<h4>

<?php echo $_SESSION['admin_name']; ?>

</h4>


<p>

Administrator

</p>


</div>


</div>

        </header>

        <!-- Alerts -->

        <?php if(isset($_SESSION['success'])){ ?>

            <div class="alert success">

                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>

            </div>

        <?php } ?>

        <?php if(isset($_SESSION['error'])){ ?>

            <div class="alert error">

                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>

            </div>

        <?php } ?>

        <!-- Form Card -->

        <div class="form-card">

            <div class="card-header">

                <h3>Customer Information</h3>

            </div>

            <form action="../backend/customer/insert.php" method="POST">

                <div class="form-grid">

                    <!-- Customer Code -->

                    <div class="form-group">

                        <label>Customer Code</label>

                        <input
                        type="text"
                        name="customer_code"
                        placeholder="CUS001"
                        required>

                    </div>

                    <!-- Customer Name -->

                    <div class="form-group">

                        <label>Customer Name</label>

                        <input
                        type="text"
                        name="customer_name"
                        placeholder="Enter Customer Name"
                        required>

                    </div>

                    <!-- Company -->

                    <div class="form-group">

                        <label>Company Name</label>

                        <input
                        type="text"
                        name="company_name"
                        placeholder="Company Name">

                    </div>

                    <!-- Email -->

                    <div class="form-group">

                        <label>Email</label>

                        <input
                        type="email"
                        name="email"
                        placeholder="example@gmail.com">

                    </div>

                    <!-- Phone -->

                    <div class="form-group">

                        <label>Phone</label>

                        <input
                        type="text"
                        name="phone"
                        placeholder="9876543210"
                        required>

                    </div>
                                        <!-- Alternate Phone -->

                    <div class="form-group">

                        <label>Alternate Phone</label>

                        <input
                        type="text"
                        name="alternate_phone"
                        placeholder="Alternate Mobile Number">

                    </div>

                    <!-- Gender -->

                    <div class="form-group">

                        <label>Gender</label>

                        <select name="gender">

                            <option value="">Select Gender</option>

                            <option value="Male">Male</option>

                            <option value="Female">Female</option>

                            <option value="Other">Other</option>

                        </select>

                    </div>

                    <!-- Date of Birth -->

                    <div class="form-group">

                        <label>Date of Birth</label>

                        <input
                        type="date"
                        name="dob">

                    </div>

                    <!-- GST Number -->

                    <div class="form-group">

                        <label>GST Number</label>

                        <input
                        type="text"
                        name="gst_number"
                        placeholder="GST Number">

                    </div>

                    <!-- PAN Number -->

                    <div class="form-group">

                        <label>PAN Number</label>

                        <input
                        type="text"
                        name="pan_number"
                        placeholder="PAN Number">

                    </div>

                    <!-- Address -->

                    <div class="form-group full-width">

                        <label>Address</label>

                        <textarea
                        name="address"
                        rows="4"
                        placeholder="Enter Full Address"></textarea>

                    </div>

                    <!-- City -->

                    <div class="form-group">

                        <label>City</label>

                        <input
                        type="text"
                        name="city"
                        placeholder="City">

                    </div>

                    <!-- State -->

                    <div class="form-group">

                        <label>State</label>

                        <input
                        type="text"
                        name="state"
                        placeholder="State">

                    </div>

                    <!-- Country -->

                    <div class="form-group">

                        <label>Country</label>

                        <input
                        type="text"
                        name="country"
                        value="India">

                    </div>

                    <!-- Pincode -->

                    <div class="form-group">

                        <label>Pincode</label>

                        <input
                        type="text"
                        name="pincode"
                        placeholder="110001">

                    </div>
                                        <!-- Opening Balance -->

                    <div class="form-group">

                        <label>Opening Balance</label>

                        <input
                        type="number"
                        name="opening_balance"
                        step="0.01"
                        value="0.00">

                    </div>

                    <!-- Credit Limit -->

                    <div class="form-group">

                        <label>Credit Limit</label>

                        <input
                        type="number"
                        name="credit_limit"
                        step="0.01"
                        value="0.00">

                    </div>

                    <!-- Status -->

                    <div class="form-group">

                        <label>Status</label>

                        <select name="status" required>

                            <option value="Active" selected>
                                Active
                            </option>

                            <option value="Inactive">
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>

                <!-- Form Buttons -->

                <div class="form-buttons">

                    <button type="submit" class="save-btn">

                        <i class="fa-solid fa-floppy-disk"></i>

                        Save Customer

                    </button>

                    <button type="reset" class="reset-btn">

                        <i class="fa-solid fa-rotate"></i>

                        Reset

                    </button>

                    <a href="customer.php" class="back-btn">

                        <i class="fa-solid fa-arrow-left"></i>

                        Back

                    </a>

                </div>

            </form>

        </div>

        <!-- Footer -->

       <footer class="footer">
    <p>
        © <?php echo date("Y"); ?>
        Business Management System | Developed in PHP & MySQL
    </p>
</footer>

    </main>

</div>

<script src="asset/js/addcustomer.js"></script>

</body>
</html>