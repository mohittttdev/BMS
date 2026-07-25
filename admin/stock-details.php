<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");




if(!isset($_GET['id'])){

    header("Location: inventory.php");
    exit();

}



$id = $_GET['id'];





// Product Details


$productQuery = mysqli_query(

    $connection,

    "SELECT * FROM products

     WHERE id='$id'"

);



$product = mysqli_fetch_assoc($productQuery);



if(!$product){

    echo "Product Not Found";
    exit();

}








// Purchase History


$purchaseHistory = mysqli_query(

    $connection,

    "SELECT

    purchase_items.*,

    purchases.invoice_no,

    purchases.purchase_date


    FROM purchase_items


    LEFT JOIN purchases


    ON purchase_items.purchase_id = purchases.id


    WHERE product_id='$id'


    ORDER BY purchase_items.id DESC"

);









// Sale History


$saleHistory = mysqli_query(

    $connection,

    "SELECT

    sale_items.*,

    sales.invoice_no,

    sales.sale_date


    FROM sale_items


    LEFT JOIN sales


    ON sale_items.sale_id = sales.id


    WHERE product_id='$id'


    ORDER BY sale_items.id DESC"

);


?>





<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Stock Details | BMS</title>




<link rel="stylesheet" href="asset/css/stock-details.css">


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





<li class="active">

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

Stock Details

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









<!-- Product Card -->


<section class="product-info-card">





<div class="product-image">


<img src="uploads/products/<?php echo $product['image']; ?>">


</div>








<div class="product-details">



<h1>

<?php echo $product['product_name']; ?>

</h1>



<p>

Category :

<?php echo $product['category']; ?>

</p>





<p>

Price :

₹ <?php echo number_format(
$product['price'],
2
); ?>

</p>




</div>








<div class="stock-box">


<h2>

<?php echo $product['stock']; ?>

</h2>


<p>

Current Stock

</p>



<?php


if($product['stock']<=0){


echo '<span class="badge danger">
Out Of Stock
</span>';



}

else if($product['stock']<=5){


echo '<span class="badge warning">
Low Stock
</span>';



}

else{


echo '<span class="badge success">
Available
</span>';



}


?>



</div>






</section>
<!-- Purchase History -->


<section class="table-card">


<h2>

Purchase History

</h2>





<table>


<thead>


<tr>


<th>
Invoice
</th>


<th>
Date
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



<?php while($purchase=mysqli_fetch_assoc($purchaseHistory)){ ?>



<tr>


<td>

<?php echo $purchase['invoice_no']; ?>

</td>




<td>

<?php echo date(

"d M Y",

strtotime($purchase['purchase_date'])

); ?>

</td>




<td>

+ <?php echo $purchase['quantity']; ?>

</td>




<td>

₹ <?php echo number_format(

$purchase['price'],

2

); ?>

</td>




<td>

₹ <?php echo number_format(

$purchase['total'],

2

); ?>

</td>



</tr>



<?php } ?>



</tbody>


</table>



</section>









<!-- Sale History -->


<section class="table-card">


<h2>

Sale History

</h2>





<table>


<thead>


<tr>


<th>
Invoice
</th>


<th>
Date
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



<?php while($sale=mysqli_fetch_assoc($saleHistory)){ ?>



<tr>


<td>

<?php echo $sale['invoice_no']; ?>

</td>




<td>

<?php echo date(

"d M Y",

strtotime($sale['sale_date'])

); ?>

</td>




<td>

- <?php echo $sale['quantity']; ?>

</td>




<td>

₹ <?php echo number_format(

$sale['price'],

2

); ?>

</td>




<td>

₹ <?php echo number_format(

$sale['total'],

2

); ?>

</td>



</tr>



<?php } ?>



</tbody>


</table>



</section>









<!-- Back Button -->


<div class="action-buttons">


<a href="inventory.php" class="back-btn">


<i class="fa-solid fa-arrow-left"></i>


Back To Inventory


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