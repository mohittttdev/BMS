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



$productQuery = mysqli_query(
    $connection,
    "SELECT * FROM products WHERE id='$id'"
);



$product = mysqli_fetch_assoc($productQuery);



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


<title>Edit Product | BMS</title>



<link rel="stylesheet" href="asset/css/add-product.css">


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


<h2>Edit Product</h2>



<div class="profile">

<i class="fa-solid fa-user-circle"></i>


<span>

<?php echo $_SESSION['admin_name']; ?>

</span>


</div>


</header>
<section class="page-title">


<h1>

Update Product

</h1>


<p>

Modify existing product details

</p>


</section>





<section class="form-card">



<form action="../backend/product/update.php" 
method="POST" 
enctype="multipart/form-data">



<input 
type="hidden"
name="id"
value="<?php echo $product['id']; ?>">





<div class="form-grid">





<!-- Product Code -->

<div class="input-group">


<label>
Product Code
</label>


<input 
type="text"
name="product_code"
value="<?php echo $product['product_code']; ?>"
required>


</div>






<!-- Product Name -->

<div class="input-group">


<label>
Product Name
</label>


<input 
type="text"
name="product_name"
value="<?php echo $product['product_name']; ?>"
required>


</div>






<!-- Category -->

<div class="input-group">


<label>
Category
</label>


<select name="category">


<option>

<?php echo $product['category']; ?>

</option>


<option>
Electronics
</option>


<option>
Clothing
</option>


<option>
Food
</option>


<option>
Other
</option>


</select>


</div>






<!-- Brand -->

<div class="input-group">


<label>
Brand
</label>


<input 
type="text"
name="brand"
value="<?php echo $product['brand']; ?>">


</div>






<!-- Supplier -->

<div class="input-group">


<label>
Supplier
</label>


<input 
type="text"
name="supplier"
value="<?php echo $product['supplier']; ?>">


</div>






<!-- Purchase Price -->

<div class="input-group">


<label>
Purchase Price
</label>


<input 
type="number"
name="purchase_price"
value="<?php echo $product['purchase_price']; ?>">


</div>






<!-- Selling Price -->

<div class="input-group">


<label>
Selling Price
</label>


<input 
type="number"
name="selling_price"
value="<?php echo $product['selling_price']; ?>"
required>


</div>






<!-- Stock -->

<div class="input-group">


<label>
Stock Quantity
</label>


<input 
type="number"
name="stock_quantity"
value="<?php echo $product['stock_quantity']; ?>"
required>


</div>






<!-- Unit -->

<div class="input-group">


<label>
Unit
</label>


<select name="unit">


<option>

<?php echo $product['unit']; ?>

</option>


<option>
Piece
</option>


<option>
Kg
</option>


<option>
Liter
</option>


<option>
Box
</option>


</select>


</div>






<!-- GST -->

<div class="input-group">


<label>
GST %
</label>


<input 
type="number"
name="gst"
value="<?php echo $product['gst']; ?>">


</div>






<!-- Status -->

<div class="input-group">


<label>
Status
</label>


<select name="status">


<option>

<?php echo $product['status']; ?>

</option>


<option>
Active
</option>


<option>
Inactive
</option>


</select>


</div>
<!-- Product Image -->


<div class="input-group">


<label>
Current Image
</label>



<?php if($product['image']!=""){ ?>


<img 
src="uploads/products/<?php echo $product['image']; ?>"
class="product-preview"
width="120">



<?php }else{ ?>


<p>No Image Available</p>


<?php } ?>


</div>






<!-- New Image -->


<div class="input-group">


<label>
Change Image
</label>


<input 
type="file"
name="image">


</div>






<!-- Description -->


<div class="input-group full">


<label>
Description
</label>


<textarea 
name="description"
rows="5"><?php echo $product['description']; ?></textarea>


</div>




</div>





<!-- Buttons -->


<div class="form-buttons">


<button type="submit" class="save-btn">


<i class="fa-solid fa-pen"></i>


Update Product


</button>




<a href="products.php" class="cancel-btn">


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