<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");




// Fetch Customers


$customers = mysqli_query(

    $connection,

    "SELECT * FROM customers
     WHERE status='Active'
     ORDER BY name ASC"

);





// Fetch Products


$products = mysqli_query(

    $connection,

    "SELECT * FROM products
     WHERE status='Active'
     ORDER BY product_name ASC"

);


?>



<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Create Sale | BMS</title>



<link rel="stylesheet" href="asset/css/add-sale.css">


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

Create Sale

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

New Sale Entry

</h1>


<p>

Create invoice and manage product sale

</p>


</section>








<section class="form-card">



<form action="../backend/sale/insert.php" method="POST">






<div class="form-grid">





<!-- Customer -->


<div class="input-group">


<label>

Select Customer

</label>



<select name="customer_id" required>


<option value="">

Choose Customer

</option>



<?php while($cus=mysqli_fetch_assoc($customers)){ ?>


<option value="<?php echo $cus['id']; ?>">


<?php echo $cus['name']; ?>


</option>



<?php } ?>



</select>



</div>









<!-- Invoice -->


<div class="input-group">


<label>

Invoice Number

</label>



<input

type="text"

name="invoice_no"

placeholder="Enter Invoice Number"

required>


</div>







<!-- Date -->


<div class="input-group">


<label>

Sale Date

</label>



<input

type="date"

name="sale_date"

value="<?php echo date('Y-m-d'); ?>"

required>


</div>





</div>
<!-- Product Section -->


<h2 class="section-title">

Select Products

</h2>





<table class="product-table">


<thead>


<tr>


<th>
Product
</th>


<th>
Available Stock
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



<tr>



<td>


<select name="product_id[]" required>


<option value="">

Select Product

</option>



<?php while($pro=mysqli_fetch_assoc($products)){ ?>


<option value="<?php echo $pro['id']; ?>">


<?php echo $pro['product_name']; ?>



</option>



<?php } ?>



</select>



</td>






<td>


<input 

type="number"

name="stock[]"

readonly>


</td>







<td>


<input 

type="number"

name="quantity[]"

value="1"

min="1"

required>


</td>







<td>


<input 

type="number"

name="price[]"

placeholder="Price"

required>


</td>







<td>


<input 

type="number"

name="total[]"

placeholder="Total"

readonly>


</td>





</tr>



</tbody>


</table>









<!-- Payment Details -->



<div class="payment-grid">





<div class="input-group">


<label>

Total Amount

</label>



<input

type="number"

name="total_amount"

placeholder="Total Amount"

required>


</div>








<div class="input-group">


<label>

Paid Amount

</label>



<input

type="number"

name="paid_amount"

value="0">


</div>








<div class="input-group">


<label>

Due Amount

</label>



<input

type="number"

name="due_amount"

value="0">


</div>








<div class="input-group">


<label>

Status

</label>



<select name="status">


<option value="Paid">

Paid

</option>


<option value="Pending">

Pending

</option>


</select>



</div>





</div>









<!-- Buttons -->



<div class="form-buttons">



<button type="submit" class="save-btn">


<i class="fa-solid fa-file-invoice-dollar"></i>


Save Sale


</button>







<a href="sales.php" class="cancel-btn">


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