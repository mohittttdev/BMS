<?php

session_start();


if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");



/* ==========================
   Dashboard Counts
========================== */


// Customers

$customer = mysqli_fetch_assoc(

    mysqli_query(

        $connection,

        "SELECT COUNT(*) AS total FROM customer"

    )

);

/* ==========================
   Monthly Sales Chart
========================== */

$chartQuery = mysqli_query($connection,"
SELECT
MONTH(sale_date) AS month,
SUM(total_amount) AS total
FROM sales
GROUP BY MONTH(sale_date)
ORDER BY MONTH(sale_date)
");

$months = [];
$totals = [];

while($row = mysqli_fetch_assoc($chartQuery)){

    $months[] = date("M", mktime(0,0,0,$row['month'],1));

    $totals[] = $row['total'];

}



// Products

$product = mysqli_fetch_assoc(

    mysqli_query(

        $connection,

        "SELECT COUNT(*) AS total FROM products"

    )

);




// Sales

$sales = mysqli_fetch_assoc(

    mysqli_query(

        $connection,

        "SELECT COUNT(*) AS total FROM sales"

    )

);




// Employees

$employee = mysqli_fetch_assoc(

    mysqli_query(

        $connection,

        "SELECT COUNT(*) AS total FROM employees"

    )

);





// Purchases

$purchase = mysqli_fetch_assoc(

    mysqli_query(

        $connection,

        "SELECT COUNT(*) AS total FROM purchases"

    )

);






/* ==========================
   Recent Sales
========================== */


$recentSales = mysqli_query(
    $connection,
    "SELECT
        sales.invoice_no,
        sales.total_amount,
        sales.status,
        sales.sale_date,
        customer.customer_name
    FROM sales
    LEFT JOIN customer
    ON sales.customer_id = customer.id
    ORDER BY sales.id DESC
    LIMIT 5"
);

if(!$recentSales){
    die("SQL Error : " . mysqli_error($connection));
}






/* ==========================
   Low Stock Products
========================== */


$lowStock = mysqli_query(
    $connection,
    "SELECT
        product_name,
        stock_quantity
     FROM products
     WHERE stock_quantity <= 5
     ORDER BY stock_quantity ASC"
);

if (!$lowStock) {
    die("SQL Error: " . mysqli_error($connection));
}





/* ==========================
   Sales Chart
========================== */


$chartSales = mysqli_query(

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

<title>BMS Admin Dashboard</title>


<link rel="stylesheet" href="asset/css/index.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>


<body>


<div class="container">







<aside class="sidebar">


<div class="logo">

<i class="fa-solid fa-chart-line"></i>

<h2>BMS</h2>

</div>





<ul>


<li class="active">

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





<!-- Sidebar -->


<button class="menu-toggle">

<i class="fa-solid fa-bars"></i>

</button>



<!-- Main -->


<main class="main">





<!-- Topbar -->


<header class="topbar">


<div class="left">


<h2>

Dashboard

</h2>


</div>






<div class="right">



<div class="search">


<input 
type="text"
placeholder="Search...">


<i class="fa fa-search"></i>


</div>





<div class="notification">


<i class="fa-solid fa-bell"></i>


<span>3</span>


</div>






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



</div>


</header>







<!-- Welcome -->


<section class="welcome">


<h1>

Welcome,

<?php echo $_SESSION['admin_name']; ?>

👋


</h1>



<p>

Manage your Business from one dashboard.

</p>


</section>
<!-- Dashboard Cards -->


<section class="cards">



<!-- Customers -->


<div class="card">


<div>


<h3>

<?php echo $customer['total']; ?>

</h3>


<p>

Total Customers

</p>


</div>


<i class="fa-solid fa-users"></i>


</div>









<!-- Products -->


<div class="card">


<div>


<h3>

<?php echo $product['total']; ?>

</h3>


<p>

Total Products

</p>


</div>


<i class="fa-solid fa-box"></i>


</div>









<!-- Sales -->


<div class="card">


<div>


<h3>

<?php echo $sales['total']; ?>

</h3>


<p>

Total Sales

</p>


</div>


<i class="fa-solid fa-money-bill"></i>


</div>









<!-- Employees -->


<div class="card">


<div>


<h3>

<?php echo $employee['total']; ?>

</h3>


<p>

Total Employees

</p>


</div>


<i class="fa-solid fa-user-tie"></i>


</div>









<!-- Purchase -->


<div class="card">


<div>


<h3>

<?php echo $purchase['total']; ?>

</h3>


<p>

Total Purchases

</p>


</div>


<i class="fa-solid fa-cart-shopping"></i>


</div>





</section>
<!-- Dashboard Content -->


<div class="dashboard-grid">



<!-- Sales Chart -->


<div class="chart-card">


<div class="card-header">


<h3>

Sales Overview

</h3>


<span>

This Year

</span>


</div>




<canvas id="salesChart"></canvas>



</div>









<!-- Recent Activity -->


<div class="activity-card">


<div class="card-header">


<h3>

Recent Activity

</h3>


</div>







<ul class="activity-list">





<li>


<i class="fa-solid fa-user-plus success"></i>


<div>


<h4>

New Customers Added

</h4>


<small>

Latest customer records

</small>


</div>


</li>








<li>


<i class="fa-solid fa-box info"></i>


<div>


<h4>

Products Updated

</h4>


<small>

Inventory management

</small>


</div>


</li>








<li>


<i class="fa-solid fa-cart-shopping warning"></i>


<div>


<h4>

New Purchase Created

</h4>


<small>

Supplier stock updated

</small>


</div>


</li>








<li>


<i class="fa-solid fa-file-invoice success"></i>


<div>


<h4>

Sales Invoice Generated

</h4>


<small>

Customer transaction completed

</small>


</div>


</li>







</ul>



</div>




</div>
<!-- Recent Sales -->


<div class="table-card">


<div class="card-header">


<h3>

Recent Sales

</h3>


<a href="sales.php">

View All

</a>


</div>





<table>


<thead>


<tr>


<th>Invoice</th>

<th>Customer</th>

<th>Amount</th>

<th>Status</th>

<th>Date</th>


</tr>


</thead>






<tbody>


<?php while($row=mysqli_fetch_assoc($recentSales)){ ?>


<tr>


<td>

<?php echo $row['invoice_no']; ?>

</td>




<td>

<?php echo $row['customer_name']; ?>

</td>




<td>

₹ <?php echo number_format(
$row['total_amount'],
2
); ?>

</td>





<td>


<?php

if($row['status']=="Paid"){


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
strtotime($row['sale_date'])
); ?>

</td>




</tr>


<?php } ?>



</tbody>


</table>


</div>









<!-- Low Stock -->


<div class="table-card">


<div class="card-header">


<h3>

Low Stock Alert

</h3>


</div>





<table>


<thead>


<tr>


<th>Product</th>

<th>Stock</th>

<th>Status</th>


</tr>


</thead>




<tbody>



<?php while($stock = mysqli_fetch_assoc($lowStock)){ ?>



<tr>



<td>

<?php echo $stock['product_name']; ?>

</td>




<td>

   <?php echo $stock['stock_quantity']; ?>

</td>




<td>


<span class="badge danger">

Low Stock

</span>


</td>




</tr>




<?php } ?>



</tbody>


</table>


</div>









<!-- Quick Actions -->


<div class="quick-actions">



<a href="customer.php" class="action-card">


<i class="fa-solid fa-users"></i>


<span>

Customers

</span>


</a>







<a href="products.php" class="action-card">


<i class="fa-solid fa-box"></i>


<span>

Products

</span>


</a>







<a href="sales.php" class="action-card">


<i class="fa-solid fa-file-invoice-dollar"></i>


<span>

Sales

</span>


</a>







<a href="reports.php" class="action-card">


<i class="fa-solid fa-chart-line"></i>


<span>

Reports

</span>


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








<!-- Chart Script -->

<script>

const ctx = document.getElementById('salesChart');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: [
            "Jan","Feb","Mar","Apr","May","Jun",
            "Jul","Aug","Sep","Oct","Nov","Dec"
        ],

        datasets: [{

            label: "Sales",

            data: [

                <?php

                $data = [];

                while($chart = mysqli_fetch_assoc($chartSales)){

                    $data[$chart['month']] = $chart['amount'];

                }

                for($i = 1; $i <= 12; $i++){

                    echo isset($data[$i]) ? $data[$i] : 0;

                    if($i < 12){
                        echo ",";
                    }

                }

                ?>

            ],

            borderColor: "#22c55e",
            backgroundColor: "rgba(34,197,94,.15)",
            borderWidth: 3,
            tension: .4,
            fill: true

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                display: true

            }

        }

    }

});


const chartMonths = <?php echo json_encode($months); ?>;
const chartTotals = <?php echo json_encode($totals); ?>;

</script>

<script src="asset/js/index.js"></script>


</body>


</html>