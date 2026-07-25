<?php

session_start();


if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");



/* =========================
   Total Sales
========================= */


$totalSales = mysqli_fetch_assoc(

mysqli_query(

$connection,

"SELECT SUM(total_amount) AS total 
FROM sales"

)

);





/* =========================
   Total Purchase
========================= */


$totalPurchase = mysqli_fetch_assoc(

mysqli_query(

$connection,

"SELECT SUM(total_amount) AS total 
FROM purchases"

)

);






/* =========================
   Total Customers
========================= */


$totalCustomer = mysqli_fetch_assoc(

mysqli_query(

$connection,

"SELECT COUNT(*) AS total 
FROM customer"

)

);







/* =========================
   Total Products
========================= */


$totalProduct = mysqli_fetch_assoc(

mysqli_query(

$connection,

"SELECT COUNT(*) AS total 
FROM products"

)

);







/* =========================
   Profit Calculation
========================= */


$profit = 

$totalSales['total'] - $totalPurchase['total'];





/* =========================
   Monthly Sales Report
========================= */


$monthlySales = mysqli_query(

$connection,

"SELECT 

MONTH(sale_date) AS month,

SUM(total_amount) AS amount


FROM sales


GROUP BY MONTH(sale_date)"

);






?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>BMS Reports</title>


<link rel="stylesheet" href="asset/css/reports.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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

<a href="customer.php">

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





<li>

<a href="inventory.php">

<i class="fa-solid fa-warehouse"></i>

Inventory

</a>

</li>





<li>

<a href="employees.php">

<i class="fa-solid fa-user-tie"></i>

Employees

</a>

</li>





<li class="active">

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

Reports

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









<!-- Report Heading -->


<section class="welcome">


<h1>

Business Reports 📊

</h1>


<p>

Analyze your business performance

</p>


</section>









<!-- Report Cards -->


<section class="cards">





<div class="card">


<div>


<h3>

₹ <?php echo number_format(
$totalSales['total'] ?? 0,
2
); ?>

</h3>


<p>

Total Sales

</p>


</div>


<i class="fa-solid fa-money-bill"></i>


</div>








<div class="card">


<div>


<h3>

₹ <?php echo number_format(
$totalPurchase['total'] ?? 0,
2
); ?>

</h3>


<p>

Total Purchase

</p>


</div>


<i class="fa-solid fa-cart-shopping"></i>


</div>








<div class="card">


<div>


<h3>

₹ <?php echo number_format(
$profit,
2
); ?>

</h3>


<p>

Total Profit

</p>


</div>


<i class="fa-solid fa-chart-line"></i>


</div>








<div class="card">


<div>


<h3>

<?php echo $totalCustomer['total']; ?>

</h3>


<p>

Customers

</p>


</div>


<i class="fa-solid fa-users"></i>


</div>






</section>
<!-- Reports Content -->


<div class="dashboard-grid">



<!-- Sales Chart -->


<div class="chart-card">


<div class="card-header">


<h3>

Monthly Sales

</h3>


</div>



<canvas id="reportChart"></canvas>



</div>






<!-- Product Stock -->


<div class="activity-card">


<div class="card-header">


<h3>

Stock Report

</h3>


</div>





<ul class="activity-list">



<?php

$stockReport = mysqli_query(
    $connection,
    "SELECT product_name, stock_quantity
     FROM products
     ORDER BY stock_quantity ASC
     LIMIT 5"
);

while($stock = mysqli_fetch_assoc($stockReport)){

?>



<li>


<i class="fa-solid fa-box"></i>


<div>


<h4>
<?php echo htmlspecialchars($stock['product_name']); ?>
</h4>

<small>
Stock :
<?php echo $stock['stock_quantity']; ?>
</small>


</div>


</li>




<?php } ?>





</ul>


</div>




</div>









<!-- Sales Report Table -->


<div class="table-card">


<div class="card-header">


<h3>

Recent Sales Report

</h3>


</div>






<table>


<thead>


<tr>


<th>

Invoice

</th>


<th>

Customer

</th>


<th>

Amount

</th>


<th>

Status

</th>


<th>

Date

</th>


</tr>


</thead>





<tbody>



<?php

$reportSales = mysqli_query(
    $connection,
    "SELECT
        sales.invoice_no,
        sales.total_amount,
        sales.status,
        sales.sale_date,
        customer.customer_name AS customer_name
    FROM sales
    LEFT JOIN customer
        ON sales.customer_id = customer.id
    ORDER BY sales.id DESC
    LIMIT 10"

);



while($sale=mysqli_fetch_assoc($reportSales)){



?>



<tr>



<td>

<?php echo $sale['invoice_no']; ?>

</td>





<td>

<?php echo $sale['customer_name']; ?>

</td>





<td>

₹ <?php echo number_format(
$sale['total_amount'],
2
); ?>

</td>





<td>



<?php


if($sale['status']=="Paid"){


echo '<span class="badge success">

Paid

</span>';


}

else{


echo '<span class="badge pending">

Pending

</span>';


}



?>



</td>






<td>

<?php echo date(
"d M Y",
strtotime($sale['sale_date'])
); ?>

</td>





</tr>



<?php } ?>



</tbody>


</table>


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








<script>


const reportCtx = document.getElementById('reportChart');



new Chart(reportCtx,{



type:'bar',



data:{



labels:[

"Jan",
"Feb",
"Mar",
"Apr",
"May",
"Jun",
"Jul",
"Aug",
"Sep",
"Oct",
"Nov",
"Dec"

],



datasets:[{


label:"Sales",

data:[


<?php


$months=[];


while($m=mysqli_fetch_assoc($monthlySales)){


$months[$m['month']]=$m['amount'];


}




for($i=1;$i<=12;$i++){


echo isset($months[$i]) 
? $months[$i]
:0;



if($i<12){

echo ",";

}


}



?>


],



borderWidth:1



}]


},




options:{


responsive:true


}



});



</script>





</body>

</html>