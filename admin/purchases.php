<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");



// Fetch Purchases

$purchases = mysqli_query(

    $connection,

    "SELECT 
    purchases.*,
    suppliers.name AS supplier_name

    FROM purchases

    LEFT JOIN suppliers

    ON purchases.supplier_id = suppliers.id

    ORDER BY purchases.id DESC"

);


?>


<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Purchases | BMS</title>



<link rel="stylesheet" href="asset/css/purchases.css">


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

Purchase Management

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
<section class="page-header">


<div>

<h1>

Purchase List

</h1>


<p>

Manage all purchase transactions

</p>


</div>




<a href="add-purchase.php" class="add-btn">


<i class="fa-solid fa-plus"></i>


Add Purchase


</a>



</section>








<!-- Purchase Table -->


<section class="table-card">



<table>



<thead>



<tr>


<th>
Invoice No
</th>



<th>
Supplier
</th>



<th>
Date
</th>



<th>
Amount
</th>



<th>
Paid
</th>



<th>
Due
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




<?php while($row = mysqli_fetch_assoc($purchases)){ ?>



<tr>



<td>

<?php echo $row['invoice_no']; ?>

</td>





<td>

<?php echo $row['supplier_name']; ?>

</td>





<td>

<?php echo date(
"d M Y",
strtotime($row['purchase_date'])
); ?>

</td>





<td>

₹ <?php echo number_format(
$row['total_amount'],
2
); ?>

</td>





<td>

₹ <?php echo number_format(
$row['paid_amount'],
2
); ?>

</td>





<td>

₹ <?php echo number_format(
$row['due_amount'],
2
); ?>

</td>





<td>


<span class="badge 
<?php echo strtolower($row['status']); ?>">



<?php echo $row['status']; ?>



</span>


</td>







<td>



<a href="view-purchase.php?id=<?php echo $row['id']; ?>"
class="view-btn">


<i class="fa-solid fa-eye"></i>


</a>






<a href="../backend/purchase/delete.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Purchase?')"
class="delete-btn">


<i class="fa-solid fa-trash"></i>


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