<?php

session_start();


if(!isset($_SESSION['admin_id'])){

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


<title>Add Employee | BMS</title>




<link rel="stylesheet" href="asset/css/add-employee.css">



<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


</head>



<body>



<!-- Sidebar -->


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




<li class="active">

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





<header class="topbar">


<h2>

Add Employee

</h2>





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









<div class="card-header">
    <h3>Employee Information</h3>
</div>







<form action="../backend/employee/insert.php" method="POST">



<div class="form-grid">
    <!-- Name -->

<div class="input-group">

<label>
Employee Name
</label>

<input 
type="text"
name="name"
placeholder="Enter employee name"
required>

</div>






<!-- Email -->

<div class="input-group">

<label>
Email
</label>

<input 
type="email"
name="email"
placeholder="Enter email">

</div>






<!-- Phone -->

<div class="input-group">

<label>
Phone
</label>

<input 
type="text"
name="phone"
placeholder="Enter phone number">

</div>






<!-- Address -->

<div class="input-group full">

<label>
Address
</label>

<textarea 
name="address"
placeholder="Enter address"></textarea>

</div>







<!-- Salary -->

<div class="input-group">

<label>
Salary
</label>

<input 
type="number"
name="salary"
placeholder="Enter salary">

</div>







<!-- Joining Date -->

<div class="input-group">

<label>
Joining Date
</label>

<input 
type="date"
name="joining_date">

</div>







<!-- Status -->

<div class="input-group">

<label>
Status
</label>


<select name="status">


<option value="Active">
Active
</option>


<option value="Inactive">
Inactive
</option>


</select>


</div>







</div>







<!-- Buttons -->

<div class="form-buttons">


<button type="submit" class="save-btn">


<i class="fa-solid fa-save"></i>


Save Employee


</button>





<a href="employees.php" class="cancel-btn">


<i class="fa-solid fa-xmark"></i>


Cancel


</a>



</div>







</form>












<!-- Footer -->


<footer class="footer">
    <p>
        © <?php echo date("Y"); ?>
        Business Management System | Developed in PHP & MySQL
    </p>
</footer>








</main>



</div>




</body>


</html>