<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");



// Fetch Suppliers

$suppliers = mysqli_query(
    $connection,
    "SELECT * FROM suppliers ORDER BY id DESC"
);


?>


<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Suppliers | BMS</title>



<link rel="stylesheet" href="asset/css/supplier.css">


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

<a href="product.php">

<i class="fa-solid fa-box"></i>

Products

</a>

</li>





<li class="active">

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

Suppliers

</h2>




<div class="profile">


<i class="fa-solid fa-user-circle"></i>


<span>

<?php echo $_SESSION['admin_name']; ?>

</span>


</div>



</header>
<section class="page-header">


<div>

<h1>

Supplier Management

</h1>


<p>

Manage all your business suppliers

</p>


</div>



<a href="add-supplier.php" class="add-btn">


<i class="fa-solid fa-plus"></i>


Add Supplier


</a>



</section>







<!-- Search -->


<div class="search-box">


<input 
type="text"
placeholder="Search Supplier...">


<i class="fa-solid fa-search"></i>


</div>








<!-- Supplier Table -->


<section class="table-card">


<table>


<thead>


<tr>


<th>
ID
</th>


<th>
Supplier Name
</th>


<th>
Company
</th>


<th>
Phone
</th>


<th>
Email
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



<?php while($row = mysqli_fetch_assoc($suppliers)){ ?>



<tr>


<td>

<?php echo $row['id']; ?>

</td>




<td>

<?php echo $row['name']; ?>

</td>




<td>

<?php echo $row['company']; ?>

</td>





<td>

<?php echo $row['phone']; ?>

</td>





<td>

<?php echo $row['email']; ?>

</td>





<td>


<span class="badge 
<?php echo strtolower($row['status']); ?>">


<?php echo $row['status']; ?>


</span>


</td>





<td>


<a href="view-supplier.php?id=<?php echo $row['id']; ?>"
class="view-btn">


<i class="fa-solid fa-eye"></i>


</a>





<a href="edit-supplier.php?id=<?php echo $row['id']; ?>"
class="edit-btn">


<i class="fa-solid fa-pen"></i>


</a>





<a href="../backend/supplier/delete.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Supplier?')"
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

Business Management System |

Developed with ❤️ PHP & MySQL


</p>


</footer>





</main>



</div>




</body>


</html>