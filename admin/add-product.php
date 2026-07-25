
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


<title>Add Product | BMS</title>


<link rel="stylesheet" href="asset/css/addproduct.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


</head>


<body>


<div class="container">


  <!-- Sidebar -->


<button class="menu-toggle">

<i class="fa-solid fa-bars"></i>

</button>
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

<a href="customer.php">

<i class="fa-solid fa-users"></i>

Customers

</a>

</li>



<li class="active">

<a href="product.php">

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

Add New Product

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





<section class="page-title">


<h1>

Create Product

</h1>


<p>

Add your business product details

</p>


</section>
<!-- Product Form -->

<section class="form-card">


<form action="../backend/product/insert.php" method="POST" enctype="multipart/form-data">


<div class="form-grid">



<!-- Product Code -->

<div class="input-group">

<label>
Product Code
</label>


<input 
type="text"
name="product_code"
placeholder="Enter Product Code"
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
placeholder="Enter Product Name"
required>

</div>





<!-- Category -->

<div class="input-group">

<label>
Category
</label>


<select name="category">


<option value="">
Select Category
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
placeholder="Enter Brand Name">


</div>





<!-- Supplier -->

<div class="input-group">


<label>
Supplier
</label>


<input 
type="text"
name="supplier"
placeholder="Enter Supplier Name">


</div>





<!-- Purchase Price -->

<div class="input-group">


<label>
Purchase Price
</label>


<input 
type="number"
name="purchase_price"
placeholder="Enter Purchase Price">


</div>





<!-- Selling Price -->

<div class="input-group">


<label>
Selling Price
</label>


<input 
type="number"
name="selling_price"
placeholder="Enter Selling Price"
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
placeholder="Enter Stock Quantity"
required>


</div>





<!-- Unit -->


<div class="input-group">


<label>
Unit
</label>


<select name="unit">


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
placeholder="Enter GST">


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





<!-- Image -->


<div class="input-group">


<label>
Product Image
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
rows="5"
placeholder="Product Description"></textarea>


</div>




</div>
<!-- Form Buttons -->


<div class="form-buttons">


<button type="submit" class="save-btn">


<i class="fa-solid fa-save"></i>


Save Product


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
        Business Management System | Developed in PHP & MySQL
    </p>
</footer>





</main>


</div>





</body>


</html>