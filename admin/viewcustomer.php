<?php

session_start();

if(!isset($_SESSION['admin_id'])){

    header("Location: login.php");
    exit();

}


include("../backend/connection.php");



if(!isset($_GET['id'])){

    header("Location: customers.php");
    exit();

}



$id = $_GET['id'];



$query = mysqli_query(
    $connection,
    "SELECT * FROM customers WHERE id='$id'"
);



if(mysqli_num_rows($query)==0){

    header("Location: customers.php");
    exit();

}



$customer = mysqli_fetch_assoc($query);



?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>View Customer | BMS</title>


<link rel="stylesheet" href="asset/css/view-customer.css">


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


<li class="active">

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

Customer Profile

</h2>



<div class="profile">


<i class="fa-solid fa-user-circle"></i>


<span>

<?php echo $_SESSION['admin_name']; ?>

</span>


</div>


</header>





<!-- Profile Card -->


<section class="customer-profile">



<div class="profile-image">


<i class="fa-solid fa-user"></i>


</div>



<div class="profile-info">


<h1>

<?php echo $customer['customer_name']; ?>

</h1>


<p>

<?php echo $customer['company_name']; ?>

</p>


<span class="status 
<?php echo strtolower($customer['status']); ?>">


<?php echo $customer['status']; ?>


</span>



</div>



<div class="profile-actions">


<a href="edit-customer.php?id=<?php echo $customer['id']; ?>"
class="edit-btn">


<i class="fa-solid fa-pen"></i>

Edit

</a>



<a href="customers.php"
class="back-btn">


<i class="fa-solid fa-arrow-left"></i>

Back

</a>


</div>



</section>





<!-- Basic Details -->


<div class="details-card">


<div class="card-title">

<h3>

Basic Information

</h3>

</div>



<div class="details-grid">


<div>

<label>Customer Code</label>

<p>
<?php echo $customer['customer_code']; ?>
</p>

</div>


<div>

<label>Email</label>

<p>
<?php echo $customer['email']; ?>
</p>

</div>



<div>

<label>Phone</label>

<p>
<?php echo $customer['phone']; ?>
</p>

</div>



<div>

<label>Gender</label>

<p>
<?php echo $customer['gender']; ?>
</p>

</div>


</div>


</div><!-- Contact Details -->

<div class="details-card">


    <div class="card-title">

        <h3>
            Contact Information
        </h3>

    </div>



    <div class="details-grid">


        <div>

            <label>
                Alternate Phone
            </label>

            <p>
                <?php echo $customer['alternate_phone']; ?>
            </p>

        </div>



        <div>

            <label>
                Date of Birth
            </label>

            <p>
                <?php echo $customer['dob']; ?>
            </p>

        </div>



        <div>

            <label>
                GST Number
            </label>

            <p>
                <?php echo $customer['gst_number']; ?>
            </p>

        </div>



        <div>

            <label>
                PAN Number
            </label>

            <p>
                <?php echo $customer['pan_number']; ?>
            </p>

        </div>


    </div>


</div>





<!-- Address Details -->


<div class="details-card">


<div class="card-title">

<h3>
    Address Information
</h3>

</div>



<div class="address-box">


<p>

<i class="fa-solid fa-location-dot"></i>


<?php echo $customer['address']; ?>

<br>


<?php echo $customer['city']; ?>,

<?php echo $customer['state']; ?>,


<?php echo $customer['country']; ?>


-

<?php echo $customer['pincode']; ?>


</p>


</div>


</div>






<!-- Balance Cards -->


<div class="balance-grid">



<div class="balance-card">


<div>

<h4>
Opening Balance
</h4>


<h2>
₹ <?php echo number_format($customer['opening_balance'],2); ?>
</h2>


</div>


<i class="fa-solid fa-wallet"></i>


</div>





<div class="balance-card">


<div>

<h4>
Credit Limit
</h4>


<h2>
₹ <?php echo number_format($customer['credit_limit'],2); ?>
</h2>


</div>


<i class="fa-solid fa-credit-card"></i>


</div>





<div class="balance-card">


<div>

<h4>
Account Status
</h4>


<h2 class="
<?php echo strtolower($customer['status']); ?>
">

<?php echo $customer['status']; ?>

</h2>


</div>


<i class="fa-solid fa-circle-check"></i>


</div>



</div>
<!-- Transaction History -->

<div class="details-card transaction-card">


<div class="card-title">

<h3>

Transaction History

</h3>


</div>



<div class="table-responsive">


<table>


<thead>


<tr>

<th>
Invoice
</th>


<th>
Type
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


<tr>


<td>
#INV-1001
</td>


<td>
Sale
</td>


<td>
₹ 12,500
</td>


<td>

<span class="paid">
Paid
</span>

</td>


<td>
Today
</td>


</tr>





<tr>


<td>
#INV-1002
</td>


<td>
Purchase
</td>


<td>
₹ 8,000
</td>


<td>

<span class="pending">
Pending
</span>

</td>


<td>
Yesterday
</td>


</tr>





<tr>


<td>
#INV-1003
</td>


<td>
Sale
</td>


<td>
₹ 5,500
</td>


<td>

<span class="paid">
Paid
</span>

</td>


<td>
10 July 2026
</td>


</tr>



</tbody>


</table>


</div>


</div>






<!-- Quick Actions -->


<div class="quick-actions">


<a href="edit-customer.php?id=<?php echo $customer['id']; ?>"
class="action-btn">


<i class="fa-solid fa-pen"></i>


Edit Customer


</a>




<a href="customers.php"
class="action-btn">


<i class="fa-solid fa-users"></i>


All Customers


</a>




<a href="../backend/customer/delete.php?id=<?php echo $customer['id']; ?>"
class="action-btn delete"
onclick="return confirm('Delete this customer?')">


<i class="fa-solid fa-trash"></i>


Delete


</a>



</div>





<!-- Footer -->


<footer class="footer">


<p>

© <?php echo date("Y"); ?>

Business Management System |

Developed with PHP & MySQL

</p>


</footer>



</main>


</div>



</body>

</html>