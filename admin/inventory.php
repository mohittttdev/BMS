<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");




// Total Products

$totalProducts = mysqli_fetch_assoc(

mysqli_query(

$connection,

"SELECT COUNT(*) as total FROM products"

)

)['total'];







$totalStock = mysqli_fetch_assoc(
    mysqli_query(
        $connection,
        "SELECT SUM(stock_quantity) AS total FROM products"
    )
)['total'];





$result = mysqli_query(
    $connection,
    "SELECT COUNT(*) AS total
     FROM products
     WHERE stock_quantity <= 5"
);

if(!$result){
    die(mysqli_error($connection));
}

$lowStock = mysqli_fetch_assoc($result)['total'];





// Stock Value

$result = mysqli_query(
    $connection,
    "SELECT SUM(stock_quantity * purchase_price) AS total
     FROM products"
);

if(!$result){
    die("SQL Error: " . mysqli_error($connection));
}

$stockValue = mysqli_fetch_assoc($result)['total'];





// Products


$products = mysqli_query(

$connection,

"SELECT *

FROM products

ORDER BY id DESC"

);



?>





<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Inventory | BMS</title>




<link rel="stylesheet" href="asset/css/inventory.css">



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

Inventory Management

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









<!-- Inventory Cards -->


<section class="cards">





<div class="card">


<div>


<h3>

<?php echo $totalProducts; ?>

</h3>


<p>

Total Products

</p>


</div>


<i class="fa-solid fa-box"></i>


</div>








<div class="card">


<div>


<h3>

<?php echo $totalStock ?? 0; ?>

</h3>


<p>

Available Stock

</p>


</div>


<i class="fa-solid fa-layer-group"></i>


</div>








<div class="card">


<div>


<h3>

<?php echo $lowStock; ?>

</h3>


<p>

Low Stock

</p>


</div>


<i class="fa-solid fa-triangle-exclamation"></i>


</div>








<div class="card">


<div>


<h3>

₹ <?php echo number_format(
$stockValue ?? 0,
2
); ?>

</h3>


<p>

Stock Value

</p>


</div>


<i class="fa-solid fa-indian-rupee-sign"></i>


</div>





</section>
<!-- Inventory Table -->


<section class="table-card">



<div class="card-header">


<h3>

Stock Details

</h3>



</div>







<table>


<thead>


<tr>


<th>
Image
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




<?php while($row=mysqli_fetch_assoc($products)){ ?>



<tr>





<td>


<img src="uploads/products/<?php echo $row['image']; ?>" 
width="50">


</td>








<td>

<?php echo $row['product_name']; ?>

</td>








<td>

<?php echo $row['category']; ?>

</td>








<td>

₹ <?php echo number_format(
$row['selling_price'],
2
); ?>

</td>

<td>

<?php echo $row['stock_quantity']; ?>

</td>

<td>

<?php

if($row['stock_quantity'] <= 0){

    echo '<span class="badge danger">
    Out Of Stock
    </span>';

}
else if($row['stock_quantity'] <= 5){

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

</td>

<td>

<a href="view-product.php?id=<?php echo $row['id']; ?>" class="view-btn">

<i class="fa-solid fa-eye"></i>

</a>

</td>





</tr>





<?php } ?>





</tbody>


</table>




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