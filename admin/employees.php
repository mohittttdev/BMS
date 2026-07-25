<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");




// Fetch Employees

$employees = mysqli_query(

    $connection,

    "SELECT * FROM employees

     ORDER BY id DESC"

);


?>



<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Employees | BMS</title>




<link rel="stylesheet" href="asset/css/employees.css">



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

Employees Management

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









<!-- Page Header -->


<section class="page-header">


<div>


<h1>

Employees

</h1>


<p>

Manage your business employees

</p>

</div>







<a href="add-employee.php" class="add-btn">


<i class="fa-solid fa-plus"></i>


Add Employee


</a>



</section><!-- Employee Table -->


<section class="table-card">



<div class="card-header">


<h3>

Employee List

</h3>


</div>






<table>


<thead>


<tr>


<th>
ID
</th>


<th>
Name
</th>


<th>
Email
</th>


<th>
Phone
</th>


<th>
Salary
</th>


<th>
Joining Date
</th>


<th>
Status
</th>


<th>
Action
</th>


</tr>


</thead>








<tbody>



<?php while($row=mysqli_fetch_assoc($employees)){ ?>



<tr>



<td>

<?php echo $row['id']; ?>

</td>






<td>

<?php echo $row['name']; ?>

</td>






<td>

<?php echo $row['email']; ?>

</td>






<td>

<?php echo $row['phone']; ?>

</td>






<td>

₹ <?php echo number_format(

$row['salary'],

2

); ?>

</td>






<td>

<?php echo date(

"d M Y",

strtotime($row['joining_date'])

); ?>

</td>






<td>


<?php


if($row['status']=="Active"){


echo '<span class="badge success">

Active

</span>';



}else{


echo '<span class="badge danger">

Inactive

</span>';



}


?>



</td>







<td>



<a href="view-employee.php?id=<?php echo $row['id']; ?>"
class="view-btn">


<i class="fa-solid fa-eye"></i>


</a>







<a href="edit-employee.php?id=<?php echo $row['id']; ?>"
class="edit-btn">


<i class="fa-solid fa-pen"></i>


</a>







<a href="../backend/employee/delete.php?id=<?php echo $row['id']; ?>"
class="delete-btn"
onclick="return confirm('Delete Employee?')">


<i class="fa-solid fa-trash"></i>


</a>





</td>






</tr>




<?php } ?>





</tbody>


</table>





</section>









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