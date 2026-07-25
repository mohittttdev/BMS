<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");



if(!isset($_GET['id'])){

    header("Location: products.php");
    exit();

}



$id = $_GET['id'];



$query = mysqli_query(
    $connection,
    "SELECT * FROM products WHERE id='$id'"
);



$product = mysqli_fetch_assoc($query);



if(!$product){

    echo "Product Not Found";
    exit();

}


?>


<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>View Product | BMS</title>



<link rel="stylesheet" href="asset/css/view-product.css">


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

Product Details

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
<section class="product-view-card">



<div class="product-image-box">



<?php if($product['image']!=""){ ?>


<img 
src="uploads/products/<?php echo $product['image']; ?>"
alt="Product Image">



<?php }else{ ?>


<i class="fa-solid fa-box-open"></i>


<?php } ?>



</div>






<div class="product-info">



<h1>

<?php echo $product['product_name']; ?>

</h1>



<p class="code">

Product Code:

<strong>

<?php echo $product['product_code']; ?>

</strong>

</p>




<span class="status 
<?php echo strtolower($product['status']); ?>">


<?php echo $product['status']; ?>


</span>




<div class="price-box">



<div>

<h3>

₹ <?php echo number_format($product['selling_price'],2); ?>

</h3>

<p>
Selling Price
</p>

</div>





<div>

<h3>

₹ <?php echo number_format($product['purchase_price'],2); ?>

</h3>

<p>
Purchase Price
</p>

</div>



</div>



</div>



</section>








<!-- Details Section -->


<section class="details-card">


<h2>

Product Information

</h2>




<div class="details-grid">



<div>

<i class="fa-solid fa-layer-group"></i>

<p>

Category

</p>

<h4>

<?php echo $product['category']; ?>

</h4>

</div>





<div>

<i class="fa-solid fa-tag"></i>

<p>

Brand

</p>

<h4>

<?php echo $product['brand']; ?>

</h4>

</div>





<div>

<i class="fa-solid fa-truck"></i>

<p>

Supplier

</p>

<h4>

<?php echo $product['supplier']; ?>

</h4>

</div>





<div>

<i class="fa-solid fa-boxes-stacked"></i>

<p>

Stock

</p>

<h4>

<?php echo $product['stock_quantity']; ?>

<?php echo $product['unit']; ?>

</h4>

</div>





<div>

<i class="fa-solid fa-percent"></i>

<p>

GST

</p>

<h4>

<?php echo $product['gst']; ?>%

</h4>

</div>





<div>

<i class="fa-solid fa-calendar"></i>

<p>

Added Date

</p>


<h4>

<?php echo date("d M Y",strtotime($product['created_at'])); ?>

</h4>


</div>



</div>



</section>
<!-- Description Section -->


<section class="details-card">


<h2>

Product Description

</h2>



<p class="description">


<?php 

if($product['description']!=""){

    echo $product['description'];

}else{

    echo "No description available";

}

?>


</p>



</section>






<!-- Action Buttons -->


<div class="action-buttons">



<a href="edit-product.php?id=<?php echo $product['id']; ?>" 
class="edit-btn">


<i class="fa-solid fa-pen"></i>


Edit Product


</a>





<a href="../backend/product/delete.php?id=<?php echo $product['id']; ?>"
onclick="return confirm('Delete this product?')"
class="delete-btn">


<i class="fa-solid fa-trash"></i>


Delete Product


</a>




<a href="products.php" class="back-btn">


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