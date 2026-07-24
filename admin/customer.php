<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include("../backend/connection.php");

/* Fetch Customers */
$query = mysqli_query($connection, "SELECT * FROM customer ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Customers | BMS</title>

 <link rel="stylesheet" href="asset/css/customer.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="container">

    <!-- ==========================
            Sidebar
    =========================== -->

    <aside class="sidebar">

        <div class="logo">

            <i class="fa-solid fa-chart-line"></i>

            <h2>BMS</h2>

        </div>

        <ul>

            <li>
                <a href="dash.php">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </li>

            <li class="active">
                <a href="customer.php">
                    <i class="fa-solid fa-users"></i>
                    Customers
                </a>
            </li>

            <li>
                <a href="product.php">
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

    <!-- ==========================
            Main Content
    =========================== -->

    <main class="main">

        <!-- Topbar -->

        <header class="topbar">

            <h2>Customer Management</h2>

            <div class="top-right">

                <div class="search-box">

                    <i class="fa-solid fa-search"></i>

                    <input
                        type="text"
                        id="searchCustomer"
                        placeholder="Search Customer...">

                </div>

                <div class="profile">

                    <i class="fa-solid fa-user-circle"></i>

                    <span>

                        <?php echo $_SESSION['admin_name']; ?>

                    </span>

                </div>

            </div>

        </header>

        <!-- Page Header -->

        <section class="page-header">

            <div>

                <h1>Customers</h1>

                <p>
                    Manage all your business customers from one place.
                </p>

            </div>

            <a href="add-customer.php" class="add-btn">

                <i class="fa-solid fa-plus"></i>

                Add Customer

            </a>

        </section>

        <!-- Customer Table Card -->

        <section class="table-card">

            <div class="table-header">

                <h3>Customer List</h3>

                <span>

                    Total Customers :
                    <?php echo mysqli_num_rows($query); ?>

                </span>

            </div>

            <div class="table-responsive">

                <table id="customerTable">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Customer Code</th>

                            <th>Name</th>

                            <th>Email</th>

                            <th>Phone</th>

                            <th>City</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody><?php

if(mysqli_num_rows($query) > 0){

    while($row = mysqli_fetch_assoc($query)){

?>

<tr>

    <td><?php echo $row['id']; ?></td>

    <td>
        <?php
        echo !empty($row['customer_code'])
            ? $row['customer_code']
            : "CUS-".$row['id'];
        ?>
    </td>

    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>

    <td><?php echo htmlspecialchars($row['email']); ?></td>

    <td><?php echo htmlspecialchars($row['phone']); ?></td>

    <td><?php echo htmlspecialchars($row['city']); ?></td>

    <td>

        <?php if($row['status']=="Active"){ ?>

            <span class="badge active">
                Active
            </span>

        <?php }else{ ?>

            <span class="badge inactive">
                Inactive
            </span>

        <?php } ?>

    </td>

    <td class="action-btns">

        <a
        href="view-customer.php?id=<?php echo $row['id']; ?>"
        class="view">

            <i class="fa-solid fa-eye"></i>

        </a>

        <a
        href="edit-customer.php?id=<?php echo $row['id']; ?>"
        class="edit">

            <i class="fa-solid fa-pen"></i>

        </a>

        <a
        href="../backend/customer/delete.php?id=<?php echo $row['id']; ?>"
        class="delete"
        onclick="return confirm('Delete this customer?')">

            <i class="fa-solid fa-trash"></i>

        </a>

    </td>

</tr>

<?php

    }

}else{

?>

<tr>

    <td colspan="8" class="empty">

        <i class="fa-solid fa-users"></i>

        <br><br>

        No Customers Found

    </td>

</tr>

<?php

}

?>

                    </tbody>

                </table>

            </div>

        </section>

        <!-- Footer -->

        <footer class="footer">

            <p>

                © <?php echo date("Y"); ?>

                Business Management System

            </p>

        </footer>

    </main>

</div>

<script src="asset/js/customer.js"></script>

</body>
</html>