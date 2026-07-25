<?php

session_start();

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");


// Fetch Products

$productQuery = mysqli_query(
    $connection,
    "SELECT * FROM products ORDER BY id DESC"
);


?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Products | BMS</title>


<link rel="stylesheet" href="asset/css/product.css">


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




<li class="active">

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

Products Management

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

Products

</h1>


<p>

Manage your business products

</p>

</div>



<a href="add-product.php" class="add-btn">


<i class="fa-solid fa-plus"></i>


Add Product


</a>


</section>
<!-- Product Table Card -->

<section class="table-cards">


<div class="table-header">


<h3>

All Products

</h3>



<div class="search-box">


<input 
type="text"
placeholder="Search Product...">



<i class="fa-solid fa-search"></i>


</div>


</div>





<div class="table-responsive">


<table>


<thead>


<tr>


<th>
Image
</th>


<th>
Code
</th>


<th>
Product Name
</th>


<th>
Category
</th>


<th>
Price
</th>


<th>
Stock
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



<?php


if(mysqli_num_rows($productQuery)>0){



while($product=mysqli_fetch_assoc($productQuery)){



?>



<tr>


<!-- Image -->


<td>


<?php if(!empty($product['image'])){ ?>


<img 
src="uploads/<?php echo $product['image']; ?>"
class="product-img">



<?php }else{ ?>


<div class="no-image">

<i class="fa-solid fa-box"></i>

</div>



<?php } ?>


</td>





<!-- Code -->

<td>

<?php echo $product['product_code']; ?>

</td>





<!-- Name -->


<td>

<strong>

<?php echo $product['product_name']; ?>

</strong>

</td>





<!-- Category -->


<td>

<?php echo $product['category']; ?>

</td>





<!-- Price -->


<td>


₹ <?php echo number_format($product['selling_price'],2); ?>


</td>





<!-- Stock -->


<td>


<?php


if($product['stock_quantity'] <= 5){


echo "<span class='low-stock'>
".$product['stock_quantity']."
</span>";


}else{


echo "<span class='stock'>
".$product['stock_quantity']."
</span>";


}


?>


</td>





<!-- Status -->


<td>


<?php


if($product['status']=="Active"){


echo "

<span class='active-status'>

Active

</span>

";


}else{


echo "

<span class='inactive-status'>

Inactive

</span>

";


}


?>


</td>





<!-- Action -->


<td>


<div class="action-buttons">



<a href="viewproduct.php?id=<?php echo $product['id']; ?>"
class="view">


<i class="fa-solid fa-eye"></i>

</a>




<a href="editproduct.php?id=<?php echo $product['id']; ?>"
class="edit">


<i class="fa-solid fa-pen"></i>

</a>




<a href="../backend/product/delete.php?id=<?php echo $product['id']; ?>"
onclick="return confirm('Delete this product?')"
class="delete">
<i class="fa-solid fa-trash"></i>
</a>



</div>


</td>




</tr>



<?php


}


}else{


?>

<tr>

<td colspan="8" class="empty">

No Products Found

</td>

</tr>


<?php


}


?>


</tbody>



</table>



</div>



</section>
<!-- Search Section -->

<div class="table-card">


<div class="table-header">


<h3>

All Products

</h3>


<div class="search-box">


<input 
type="text"
placeholder="Search Product...">


<i class="fa-solid fa-search"></i>


</div>


</div>





<!-- Product Table -->


<div class="table-responsive">


<table>


<thead>


<tr>

<th>
#
</th>


<th>
Product
</th>


<th>
Code
</th>


<th>
Category
</th>


<th>
Price
</th>


<th>
Stock
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


<?php


$count = 1;


while($product = mysqli_fetch_assoc($productQuery)){


?>



<tr>


<td>

<?php echo $count++; ?>

</td>



<td class="product-info">


<?php

if(!empty($product['image'])){

?>


<img src="uploads/<?php echo $product['image']; ?>">


<?php

}else{

?>

<i class="fa-solid fa-box product-icon"></i>


<?php

}

?>



<div>

<h4>

<?php echo $product['product_name']; ?>

</h4>


<small>

<?php echo $product['brand']; ?>

</small>


</div>


</td>





<td>

<?php echo $product['product_code']; ?>

</td>





<td>

<?php echo $product['category']; ?>

</td>





<td>

₹ <?php echo $product['selling_price']; ?>

</td>





<td>


<?php echo $product['stock_quantity']; ?>


</td>





<td>


<?php

if($product['status']=="Active"){

?>

<span class="active-status">

Active

</span>


<?php

}else{

?>

<span class="inactive-status">

Inactive

</span>


<?php

}

?>


</td>





<td>


<div class="action-buttons">



<a href="view-product.php?id=<?php echo $product['id']; ?>"
class="view">


<i class="fa-solid fa-eye"></i>

</a>




<a href="edit-product.php?id=<?php echo $product['id']; ?>"
class="edit">


<i class="fa-solid fa-pen"></i>

</a>




<a href="../backend/product/delete.php?id=<?php echo $product['id']; ?>"
class="delete"
onclick="return confirm('Delete Product?')">


<i class="fa-solid fa-trash"></i>

</a>



</div>


</td>



</tr>



<?php

}


?>



</tbody>


</table>


</div>



</div>
<!-- Product Summary Cards -->

<section class="summary-cards">


<div class="summary-card">


<div>

<h3>

<?php

$totalProducts = mysqli_num_rows(
    mysqli_query($connection,"SELECT id FROM products")
);

echo $totalProducts;

?>

</h3>


<p>
Total Products
</p>


</div>


<i class="fa-solid fa-box"></i>


</div>





<div class="summary-card">


<div>

<h3>

<?php

$activeProducts = mysqli_num_rows(
    mysqli_query(
        $connection,
        "SELECT id FROM products WHERE status='Active'"
    )
);

echo $activeProducts;

?>

</h3>


<p>
Active Products
</p>


</div>


<i class="fa-solid fa-circle-check"></i>


</div>





<div class="summary-card">


<div>

<h3>

<?php

$stockProducts = mysqli_fetch_assoc(
    mysqli_query(
        $connection,
        "SELECT SUM(stock_quantity) AS total FROM products"
    )
);


echo $stockProducts['total'] ?? 0;


?>

</h3>


<p>
Total Stock
</p>


</div>


<i class="fa-solid fa-warehouse"></i>


</div>




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