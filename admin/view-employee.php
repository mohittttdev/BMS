<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");




if(!isset($_GET['id'])){

    header("Location: employees.php");
    exit();

}



$id = $_GET['id'];




// Fetch Employee

$query = mysqli_query(

    $connection,

    "SELECT * FROM employees

     WHERE id='$id'"

);



$employee = mysqli_fetch_assoc($query);



if(!$employee){

    echo "Employee Not Found";
    exit();

}


?>



<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>View Employee | BMS</title>




<link rel="stylesheet" href="asset/css/view-employee.css">



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

Employee Details

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









<!-- Employee Profile -->


<section class="profile-card">





<div class="profile-icon">


<i class="fa-solid fa-user-tie"></i>


</div>






<div class="employee-title">


<h1>

<?php echo $employee['name']; ?>

</h1>


<p>

Employee Profile

</p>


</div>







</section>
<!-- Employee Details -->

<section class="details-card">


<h2>

Employee Information

</h2>





<div class="details-grid">



<div>

<h4>
Name
</h4>

<p>

<?php echo $employee['name']; ?>

</p>

</div>





<div>

<h4>
Email
</h4>

<p>

<?php echo $employee['email']; ?>

</p>

</div>







<div>

<h4>
Phone
</h4>

<p>

<?php echo $employee['phone']; ?>

</p>

</div>







<div>

<h4>
Salary
</h4>

<p>

₹ <?php echo number_format(
$employee['salary'],
2
); ?>

</p>

</div>







<div>

<h4>
Joining Date
</h4>

<p>

<?php echo date(
    "d M Y",
    strtotime($employee['joining_data'])
); ?>

</p>

</div>







<div>

<h4>
Status
</h4>


<p>


<?php


if($employee['status']=="Active"){


echo '<span class="badge success">
Active
</span>';



}else{


echo '<span class="badge danger">
Inactive
</span>';



}



?>


</p>


</div>






<div class="full">


<h4>
Address
</h4>


<p>

<?php echo $employee['address']; ?>

</p>


</div>






</div>


</section>









<!-- Action Buttons -->


<div class="action-buttons">


<a href="edit-employee.php?id=<?php echo $employee['id']; ?>"
class="edit-btn">


<i class="fa-solid fa-pen"></i>


Edit Employee


</a>






<a href="employees.php"
class="cancel-btn">


<i class="fa-solid fa-arrow-left"></i>


Back


</a>



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




</body>


</html>