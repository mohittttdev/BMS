<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");



if(!isset($_GET['id'])){

    header("Location: purchases.php");
    exit();

}



$id = $_GET['id'];



// Purchase Details

$purchaseQuery = mysqli_query(

    $connection,

    "SELECT 
    purchases.*,
    suppliers.name AS supplier_name,
    suppliers.company,
    suppliers.phone,
    suppliers.email

    FROM purchases

    LEFT JOIN suppliers

    ON purchases.supplier_id = suppliers.id

    WHERE purchases.id='$id'"

);



$purchase = mysqli_fetch_assoc($purchaseQuery);



if(!$purchase){

    echo "Purchase Not Found";
    exit();

}




// Purchase Items


$items = mysqli_query(

    $connection,

    "SELECT 

    purchase_items.*,

    products.product_name


    FROM purchase_items


    LEFT JOIN products


    ON purchase_items.product_id = products.id


    WHERE purchase_id='$id'"

);



?>


<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>View Purchase | BMS</title>



<link rel="stylesheet" href="asset/css/view-purchase.css">


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




<li class="active">

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

Purchase Invoice

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








<!-- Invoice Header -->


<section class="invoice-card">



<div class="invoice-title">


<div>


<h1>

Purchase #<?php echo $purchase['invoice_no']; ?>

</h1>


<p>

Date :

<?php echo date(
"d M Y",
strtotime($purchase['purchase_date'])
); ?>

</p>


</div>




<span class="status 
<?php echo strtolower($purchase['status']); ?>">


<?php echo $purchase['status']; ?>


</span>



</div>





</section>








<!-- Supplier Details -->


<section class="supplier-card">



<h2>

Supplier Information

</h2>





<div class="supplier-grid">



<div>

<i class="fa-solid fa-user"></i>


<p>Name</p>


<h4>

<?php echo $purchase['supplier_name']; ?>

</h4>


</div>





<div>

<i class="fa-solid fa-building"></i>


<p>Company</p>


<h4>

<?php echo $purchase['company']; ?>

</h4>


</div>





<div>

<i class="fa-solid fa-phone"></i>


<p>Phone</p>


<h4>

<?php echo $purchase['phone']; ?>

</h4>


</div>





<div>

<i class="fa-solid fa-envelope"></i>


<p>Email</p>


<h4>

<?php echo $purchase['email']; ?>

</h4>


</div>



</div>



</section>
<!-- Product Details -->


<section class="table-card">


<h2>

Purchased Products

</h2>




<table>


<thead>


<tr>


<th>
Product
</th>


<th>
Quantity
</th>


<th>
Price
</th>


<th>
Total
</th>


</tr>


</thead>




<tbody>



<?php while($item = mysqli_fetch_assoc($items)){ ?>



<tr>


<td>

<?php echo $item['product_name']; ?>

</td>




<td>

<?php echo $item['quantity']; ?>

</td>




<td>

₹ <?php echo number_format($item['price'],2); ?>

</td>




<td>

₹ <?php echo number_format($item['total'],2); ?>

</td>



</tr>



<?php } ?>




</tbody>



</table>



</section>









<!-- Payment Summary -->


<section class="payment-summary">



<div class="summary-box">


<h3>

Total Amount

</h3>


<p>

₹ <?php echo number_format(
$purchase['total_amount'],
2
); ?>

</p>


</div>





<div class="summary-box">


<h3>

Paid Amount

</h3>


<p>

₹ <?php echo number_format(
$purchase['paid_amount'],
2
); ?>

</p>


</div>






<div class="summary-box">


<h3>

Due Amount

</h3>


<p>

₹ <?php echo number_format(
$purchase['due_amount'],
2
); ?>

</p>


</div>




</section>








<!-- Buttons -->


<div class="action-buttons">



<button onclick="window.print()" class="print-btn">


<i class="fa-solid fa-print"></i>


Print Invoice


</button>





<a href="purchases.php" class="back-btn">


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