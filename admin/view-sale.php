<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");



if(!isset($_GET['id'])){

    header("Location: sales.php");
    exit();

}



$id = $_GET['id'];





// Sale Details


$saleQuery = mysqli_query(

    $connection,

    "SELECT 

    sales.*,

    customers.name AS customer_name,
    customers.phone,
    customers.email


    FROM sales


    LEFT JOIN customers


    ON sales.customer_id = customers.id


    WHERE sales.id='$id'"

);



$sale = mysqli_fetch_assoc($saleQuery);





if(!$sale){

    echo "Sale Not Found";
    exit();

}







// Sale Items


$items = mysqli_query(

    $connection,

    "SELECT

    sale_items.*,

    products.product_name


    FROM sale_items


    LEFT JOIN products


    ON sale_items.product_id = products.id


    WHERE sale_id='$id'"

);



?>



<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>View Sale | BMS</title>



<link rel="stylesheet" href="asset/css/view-sale.css">


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





<li class="active">

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

Sale Invoice

</h2>




<div class="profile">


<i class="fa-solid fa-user-circle"></i>


<span>

<?php echo $_SESSION['admin_name']; ?>

</span>


</div>


</header>








<!-- Invoice Header -->


<section class="invoice-card">



<div class="invoice-title">



<div>


<h1>

Invoice #<?php echo $sale['invoice_no']; ?>

</h1>



<p>


Date :

<?php echo date(

"d M Y",

strtotime($sale['sale_date'])

); ?>


</p>



</div>







<span class="status 
<?php echo strtolower($sale['status']); ?>">



<?php echo $sale['status']; ?>



</span>





</div>




</section>









<!-- Customer Details -->


<section class="customer-card">



<h2>

Customer Information

</h2>





<div class="customer-grid">





<div>


<i class="fa-solid fa-user"></i>


<p>Name</p>


<h4>

<?php echo $sale['customer_name']; ?>

</h4>


</div>






<div>


<i class="fa-solid fa-phone"></i>


<p>Phone</p>


<h4>

<?php echo $sale['phone']; ?>

</h4>


</div>






<div>


<i class="fa-solid fa-envelope"></i>


<p>Email</p>


<h4>

<?php echo $sale['email']; ?>

</h4>


</div>




<div>


<i class="fa-solid fa-file-invoice"></i>


<p>Invoice</p>


<h4>

<?php echo $sale['invoice_no']; ?>

</h4>


</div>





</div>



</section>
<!-- Product Details -->


<section class="table-card">


<h2>

Sold Products

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



<?php while($item=mysqli_fetch_assoc($items)){ ?>



<tr>


<td>

<?php echo $item['product_name']; ?>

</td>




<td>

<?php echo $item['quantity']; ?>

</td>




<td>

₹ <?php echo number_format(
$item['price'],
2
); ?>

</td>




<td>

₹ <?php echo number_format(
$item['total'],
2
); ?>

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

$sale['total_amount'],

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

$sale['paid_amount'],

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

$sale['due_amount'],

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







<a href="sales.php" class="back-btn">


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