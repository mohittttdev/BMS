<?php
// session_start();

// if (!isset($_SESSION['admin_id'])) {
//     header("Location: login.php");
//     exit();
// }

include("../backend/connection.php");

/* Dashboard Counts */

// $customer = mysqli_fetch_assoc(mysqli_query($connection,"SELECT COUNT(*) AS total FROM customers"));
// $product  = mysqli_fetch_assoc(mysqli_query($connection,"SELECT COUNT(*) AS total FROM products"));
// $sales    = mysqli_fetch_assoc(mysqli_query($connection,"SELECT COUNT(*) AS total FROM sales"));
// $employee = mysqli_fetch_assoc(mysqli_query($connection,"SELECT COUNT(*) AS total FROM employees"));
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>BMS Admin Dashboard</title>

<link rel="stylesheet" href="asset/css/dash.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<div class="container">

<!-- Sidebar -->
 <button class="menu-toggle">
    <i class="fa-solid fa-bars"></i>
</button>

<aside class="sidebar">
    

<div class="logo">

<i class="fa-solid fa-chart-line"></i>

<h2>BMS</h2>

</div>

<ul>

<li class="active">
<a href="index.php">
<i class="fa-solid fa-house"></i>
Dashboard
</a>
</li>

<li>
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
<a href="purchases.php">
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

<!-- Top Navbar -->

<header class="topbar">

<div class="left">

<h2>Dashboard</h2>

</div>

<div class="right">

<div class="search">

<input
type="text"
placeholder="Search...">

<i class="fa fa-search"></i>

</div>

<div class="notification">

<i class="fa-solid fa-bell"></i>

<span>3</span>

</div>

<div class="profile">

<img src="assets/images/admin.png">

<div>

<h4><?php echo $_SESSION['admin_name']; ?></h4>

<p>Administrator</p>

</div>

</div>

</div>

</header>

<!-- Welcome -->

<section class="welcome">

<h1>

Welcome,

<?php echo $_SESSION['admin_name']; ?>

👋

</h1>

<p>

Manage your Business from one dashboard.

</p>

</section>

<!-- Cards -->

<section class="cards">

<div class="card">

<div>

<h3>

<?php echo $customer['total']; ?>

</h3>

<p>Total Customers</p>

</div>

<i class="fa-solid fa-users"></i>

</div>

<div class="card">

<div>

<h3>

<?php echo $product['total']; ?>

</h3>

<p>Total Products</p>

</div>

<i class="fa-solid fa-box"></i>

</div>

<div class="card">

<div>

<h3>

<?php echo $sales['total']; ?>

</h3>

<p>Total Sales</p>

</div>

<i class="fa-solid fa-money-bill"></i>

</div>

<div class="card">

<div>

<h3>

<?php echo $employee['total']; ?>

</h3>

<p>Total Employees</p>

</div>

<i class="fa-solid fa-user-tie"></i>

</div>

</section><!-- ===========================
     Dashboard Content
=========================== -->

<div class="dashboard-grid">

    <!-- Sales Chart -->

    <div class="chart-card">

        <div class="card-header">

            <h3>Sales Overview</h3>

            <span>This Month</span>

        </div>

        <canvas id="salesChart"></canvas>

    </div>

    <!-- Recent Activity -->

    <div class="activity-card">

        <div class="card-header">

            <h3>Recent Activity</h3>

        </div>

        <ul class="activity-list">

            <li>

                <i class="fa-solid fa-circle-check success"></i>

                <div>

                    <h4>New Customer Added</h4>

                    <small>2 Minutes Ago</small>

                </div>

            </li>

            <li>

                <i class="fa-solid fa-box info"></i>

                <div>

                    <h4>Product Updated</h4>

                    <small>15 Minutes Ago</small>

                </div>

            </li>

            <li>

                <i class="fa-solid fa-cart-shopping warning"></i>

                <div>

                    <h4>New Purchase Created</h4>

                    <small>35 Minutes Ago</small>

                </div>

            </li>

            <li>

                <i class="fa-solid fa-money-bill success"></i>

                <div>

                    <h4>Invoice Generated</h4>

                    <small>1 Hour Ago</small>

                </div>

            </li>

        </ul>

    </div>

</div>

<!-- ===========================
     Recent Orders
=========================== -->

<div class="table-card">

    <div class="card-header">

        <h3>Recent Sales</h3>

        <a href="sales.php">View All</a>

    </div>

    <table>

        <thead>

            <tr>

                <th>Invoice</th>

                <th>Customer</th>

                <th>Amount</th>

                <th>Status</th>

                <th>Date</th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td>#1001</td>

                <td>Rahul Sharma</td>

                <td>₹12,500</td>

                <td><span class="badge success">Paid</span></td>

                <td>Today</td>

            </tr>

            <tr>

                <td>#1002</td>

                <td>Aman Verma</td>

                <td>₹8,250</td>

                <td><span class="badge pending">Pending</span></td>

                <td>Today</td>

            </tr>

            <tr>

                <td>#1003</td>

                <td>Neha Singh</td>

                <td>₹5,100</td>

                <td><span class="badge success">Paid</span></td>

                <td>Yesterday</td>

            </tr>

            <tr>

                <td>#1004</td>

                <td>Rohit Kumar</td>

                <td>₹19,999</td>

                <td><span class="badge success">Paid</span></td>

                <td>Yesterday</td>

            </tr>

        </tbody>

    </table>

</div>

<!-- ===========================
     Quick Actions
=========================== -->

<div class="quick-actions">

    <a href="customers.php" class="action-card">

        <i class="fa-solid fa-users"></i>

        <span>Customers</span>

    </a>

    <a href="products.php" class="action-card">

        <i class="fa-solid fa-box"></i>

        <span>Products</span>

    </a>

    <a href="sales.php" class="action-card">

        <i class="fa-solid fa-file-invoice-dollar"></i>

        <span>Sales</span>

    </a>

    <a href="reports.php" class="action-card">

        <i class="fa-solid fa-chart-line"></i>

        <span>Reports</span>

    </a>

</div>

<!-- Footer -->

<footer class="footer">

    <p>

        © <?php echo date("Y"); ?> Business Management System |
        Developed with ❤️ in PHP & MySQL

    </p>

</footer>

</main>

</div>




<script src="asset/js/dash.js"></script>
</body>

</html>