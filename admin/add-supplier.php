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


<title>Add Supplier | BMS</title>



<link rel="stylesheet" href="asset/css/add-supplier.css">


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

<a href="reports.php">

<i class="fa-solid fa-chart-column"></i>

Reports

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

Add Supplier

</h2>




<div class="profile">


<i class="fa-solid fa-user-circle"></i>


<span>

<?php echo $_SESSION['admin_name']; ?>

</span>


</div>



</header>
<section class="page-title">


<h1>

Add New Supplier

</h1>


<p>

Create supplier profile for your business

</p>


</section>






<section class="form-card">



<form action="../backend/supplier/insert.php" method="POST">





<div class="form-grid">





<!-- Supplier Name -->


<div class="input-group">


<label>
Supplier Name
</label>


<input 
type="text"
name="name"
placeholder="Enter Supplier Name"
required>


</div>






<!-- Company -->


<div class="input-group">


<label>
Company Name
</label>


<input 
type="text"
name="company"
placeholder="Enter Company Name">


</div>







<!-- Phone -->


<div class="input-group">


<label>
Phone Number
</label>


<input 
type="text"
name="phone"
placeholder="Enter Phone Number"
required>


</div>







<!-- Email -->


<div class="input-group">


<label>
Email Address
</label>


<input 
type="email"
name="email"
placeholder="Enter Email">


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







<!-- Address -->


<div class="input-group full">


<label>
Address
</label>



<textarea
name="address"
rows="5"
placeholder="Enter Supplier Address"></textarea>


</div>





</div>
<!-- Buttons -->


<div class="form-buttons">


<button type="submit" class="save-btn">


<i class="fa-solid fa-plus"></i>


Save Supplier


</button>





<a href="suppliers.php" class="cancel-btn">


<i class="fa-solid fa-xmark"></i>


Cancel


</a>



</div>





</form>


</section>







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