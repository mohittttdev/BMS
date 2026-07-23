<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include("../backend/connection.php");


/* Customer ID Check */

if(!isset($_GET['id'])){

    header("Location: customer.php");
    exit();

}

$id = $_GET['id'];


/* Fetch Customer Data */

$result = mysqli_query(
    $connection,
    "SELECT * FROM customer WHERE id='$id'"
);


if(mysqli_num_rows($result)==0){

    header("Location: customer.php");
    exit();

}


$customer = mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Customer | BMS</title>


<link rel="stylesheet" href="asset/css/addcustomer.css">


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



<!-- Main -->


<main class="main">



<!-- Topbar -->


<header class="topbar">


<h2>Edit Customer</h2>


<div class="profile">

<i class="fa-solid fa-user-circle"></i>

<span>

<?php echo $_SESSION['admin_name']; ?>

</span>


</div>


</header>




<!-- Form Card -->


<div class="form-card">


<div class="card-header">


<h3>

Update Customer Information

</h3>


</div>




<form action="../backend/customer/update.php" method="POST">


<input 
type="hidden"
name="id"
value="<?php echo $customer['id']; ?>">



<div class="form-grid">



<!-- Customer Code -->


<div class="form-group">


<label>Customer Code</label>


<input

type="text"

name="customer_code"

value="<?php echo $customer['customer_code']; ?>"

required>


</div>




<!-- Customer Name -->


<div class="form-group">


<label>Customer Name</label>


<input

type="text"

name="customer_name"

value="<?php echo $customer['customer_name']; ?>"

required>


</div>





<!-- Company Name -->


<div class="form-group">


<label>Company Name</label>


<input

type="text"

name="company_name"

value="<?php echo $customer['company_name']; ?>">


</div>




<!-- Email -->


<div class="form-group">


<label>Email</label>


<input

type="email"

name="email"

value="<?php echo $customer['email']; ?>">


</div>




<!-- Phone -->


<div class="form-group">


<label>Phone</label>


<input

type="text"

name="phone"

value="<?php echo $customer['phone']; ?>"

required>


</div>
<!-- Alternate Phone -->

<div class="form-group">

    <label>Alternate Phone</label>

    <input

    type="text"

    name="alternate_phone"

    value="<?php echo $customer['alternate_phone']; ?>"

    placeholder="Alternate Mobile Number">

</div>



<!-- Gender -->

<div class="form-group">

    <label>Gender</label>

    <select name="gender">


        <option value="">
            Select Gender
        </option>


        <option value="Male"
        <?php
        if($customer['gender']=="Male"){
            echo "selected";
        }
        ?>>
            Male
        </option>



        <option value="Female"
        <?php
        if($customer['gender']=="Female"){
            echo "selected";
        }
        ?>>
            Female
        </option>



        <option value="Other"
        <?php
        if($customer['gender']=="Other"){
            echo "selected";
        }
        ?>>
            Other
        </option>


    </select>

</div>




<!-- DOB -->

<div class="form-group">

    <label>Date of Birth</label>

    <input

    type="date"

    name="dob"

    value="<?php echo $customer['dob']; ?>">

</div>




<!-- GST -->

<div class="form-group">

    <label>GST Number</label>

    <input

    type="text"

    name="gst_number"

    value="<?php echo $customer['gst_number']; ?>"

    placeholder="GST Number">

</div>




<!-- PAN -->

<div class="form-group">

    <label>PAN Number</label>

    <input

    type="text"

    name="pan_number"

    value="<?php echo $customer['pan_number']; ?>"

    placeholder="PAN Number">

</div>




<!-- Address -->

<div class="form-group full-width">


    <label>Address</label>


    <textarea

    name="address"

    rows="4"

    placeholder="Enter Address"><?php echo $customer['address']; ?></textarea>


</div>





<!-- City -->

<div class="form-group">

    <label>City</label>

    <input

    type="text"

    name="city"

    value="<?php echo $customer['city']; ?>">

</div>





<!-- State -->

<div class="form-group">

    <label>State</label>

    <input

    type="text"

    name="state"

    value="<?php echo $customer['state']; ?>">

</div>





<!-- Country -->

<div class="form-group">

    <label>Country</label>

    <input

    type="text"

    name="country"

    value="<?php echo $customer['country']; ?>">

</div>





<!-- Pincode -->

<div class="form-group">

    <label>Pincode</label>

    <input

    type="text"

    name="pincode"

    value="<?php echo $customer['pincode']; ?>">

</div>
<!-- Opening Balance -->

<div class="form-group">

    <label>Opening Balance</label>

    <input

    type="number"

    name="opening_balance"

    step="0.01"

    value="<?php echo $customer['opening_balance']; ?>">

</div>



<!-- Credit Limit -->

<div class="form-group">

    <label>Credit Limit</label>

    <input

    type="number"

    name="credit_limit"

    step="0.01"

    value="<?php echo $customer['credit_limit']; ?>">

</div>



<!-- Status -->

<div class="form-group">

    <label>Status</label>


    <select name="status">


        <option value="Active"

        <?php

        if($customer['status']=="Active"){

            echo "selected";

        }

        ?>>

            Active

        </option>



        <option value="Inactive"

        <?php

        if($customer['status']=="Inactive"){

            echo "selected";

        }

        ?>>

            Inactive

        </option>


    </select>


</div>



</div>
<!-- form-grid close -->



<!-- Buttons -->

<div class="form-buttons">


<button type="submit" class="save-btn">

    <i class="fa-solid fa-pen-to-square"></i>

    Update Customer

</button>



<button type="reset" class="reset-btn">

    <i class="fa-solid fa-rotate"></i>

    Reset

</button>



<a href="customer.php" class="back-btn">

    <i class="fa-solid fa-arrow-left"></i>

    Back

</a>



</div>



</form>


</div>
<!-- form-card close -->



<!-- Footer -->


<footer class="footer">

<p>

© <?php echo date("Y"); ?>

Business Management System |

PHP & MySQL

</p>

</footer>



</main>


</div>


</body>

</html>