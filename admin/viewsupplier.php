<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");



if(!isset($_GET['id'])){

    header("Location: suppliers.php");
    exit();

}



$id = $_GET['id'];



$query = mysqli_query(
    $connection,
    "SELECT * FROM suppliers WHERE id='$id'"
);



$supplier = mysqli_fetch_assoc($query);



if(!$supplier){

    echo "Supplier Not Found";
    exit();

}

?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>View Supplier | BMS</title>


<link rel="stylesheet" href="asset/css/view-supplier.css">


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




<li class="active">

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

Supplier Details

</h2>




<div class="profile">


<i class="fa-solid fa-user-circle"></i>


<span>

<?php echo $_SESSION['admin_name']; ?>

</span>


</div>



</header>
<section class="supplier-profile-card">



<div class="supplier-icon">


<i class="fa-solid fa-truck"></i>


</div>





<div class="supplier-info">


<h1>

<?php echo $supplier['name']; ?>

</h1>



<p class="company">


<i class="fa-solid fa-building"></i>


<?php echo $supplier['company']; ?>


</p>




<span class="status 
<?php echo strtolower($supplier['status']); ?>">


<?php echo $supplier['status']; ?>


</span>



</div>



</section>








<!-- Supplier Details -->


<section class="details-card">



<h2>

Supplier Information

</h2>




<div class="details-grid">





<div>

<i class="fa-solid fa-user"></i>


<p>
Supplier Name
</p>


<h4>

<?php echo $supplier['name']; ?>

</h4>


</div>






<div>

<i class="fa-solid fa-building"></i>


<p>
Company
</p>


<h4>

<?php echo $supplier['company']; ?>

</h4>


</div>






<div>

<i class="fa-solid fa-phone"></i>


<p>
Phone
</p>


<h4>

<?php echo $supplier['phone']; ?>

</h4>


</div>







<div>

<i class="fa-solid fa-envelope"></i>


<p>
Email
</p>


<h4>

<?php echo $supplier['email']; ?>

</h4>


</div>






<div class="full-detail">


<i class="fa-solid fa-location-dot"></i>


<p>
Address
</p>


<h4>

<?php echo $supplier['address']; ?>

</h4>


</div>






<div>

<i class="fa-solid fa-calendar"></i>


<p>
Joined Date
</p>


<h4>

<?php echo date("d M Y",strtotime($supplier['created_at'])); ?>

</h4>


</div>




</div>


</section>
<!-- Purchase Summary -->


<section class="summary-cards">



<div class="summary-card">


<i class="fa-solid fa-cart-shopping"></i>


<div>


<h3>

0

</h3>


<p>

Total Purchases

</p>


</div>


</div>





<div class="summary-card">


<i class="fa-solid fa-money-bill"></i>


<div>


<h3>

₹ 0.00

</h3>


<p>

Total Amount

</p>


</div>


</div>





<div class="summary-card">


<i class="fa-solid fa-wallet"></i>


<div>


<h3>

₹ 0.00

</h3>


<p>

Balance Due

</p>


</div>


</div>




</section>






<!-- Actions -->


<div class="action-buttons">



<a href="edit-supplier.php?id=<?php echo $supplier['id']; ?>"
class="edit-btn">


<i class="fa-solid fa-pen"></i>


Edit Supplier


</a>





<a href="../backend/supplier/delete.php?id=<?php echo $supplier['id']; ?>"
onclick="return confirm('Delete Supplier?')"
class="delete-btn">


<i class="fa-solid fa-trash"></i>


Delete Supplier


</a>





<a href="suppliers.php" class="back-btn">


<i class="fa-solid fa-arrow-left"></i>


Back


</a>




</div>







<!-- Footer -->


<footer class="footer">


<p>


© <?php echo date("Y"); ?>

Business Management System |

Developed with ❤️ PHP & MySQL


</p>


</footer>






</main>



</div>




</body>


</html>