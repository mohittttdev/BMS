<?php
session_start();

include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customer_code   = mysqli_real_escape_string($connection, $_POST['customer_code']);
    $customer_name   = mysqli_real_escape_string($connection, $_POST['customer_name']);
    $company_name    = mysqli_real_escape_string($connection, $_POST['company_name']);
    $email           = mysqli_real_escape_string($connection, $_POST['email']);
    $phone           = mysqli_real_escape_string($connection, $_POST['phone']);
    $alternate_phone = mysqli_real_escape_string($connection, $_POST['alternate_phone']);
    $gender          = mysqli_real_escape_string($connection, $_POST['gender']);
    $dob             = mysqli_real_escape_string($connection, $_POST['dob']);
    $gst_number      = mysqli_real_escape_string($connection, $_POST['gst_number']);
    $pan_number      = mysqli_real_escape_string($connection, $_POST['pan_number']);
    $address         = mysqli_real_escape_string($connection, $_POST['address']);
    $city            = mysqli_real_escape_string($connection, $_POST['city']);
    $state           = mysqli_real_escape_string($connection, $_POST['state']);
    $country         = mysqli_real_escape_string($connection, $_POST['country']);
    $pincode         = mysqli_real_escape_string($connection, $_POST['pincode']);
    $opening_balance = mysqli_real_escape_string($connection, $_POST['opening_balance']);
    $credit_limit    = mysqli_real_escape_string($connection, $_POST['credit_limit']);
    $status          = mysqli_real_escape_string($connection, $_POST['status']);

    // Duplicate Check
    $check = mysqli_query(
        $connection,
        "SELECT id FROM customer 
         WHERE email='$email' OR phone='$phone'"
    );

    if (mysqli_num_rows($check) > 0) {

        $_SESSION['error'] = "Customer already exists.";

        header("Location: ../../admin/add-customer.php");
        exit();

    }

    // Insert Customer
    $insert = mysqli_query($connection, "
        INSERT INTO customer(
            customer_code,
            customer_name,
            company_name,
            email,
            phone,
            alternate_phone,
            gender,
            dob,
            gst_number,
            pan_number,
            address,
            city,
            state,
            country,
            pincode,
            opening_balance,
            credit_limit,
            status
        ) VALUES (
            '$customer_code',
            '$customer_name',
            '$company_name',
            '$email',
            '$phone',
            '$alternate_phone',
            '$gender',
            '$dob',
            '$gst_number',
            '$pan_number',
            '$address',
            '$city',
            '$state',
            '$country',
            '$pincode',
            '$opening_balance',
            '$credit_limit',
            '$status'
        )
    ");

    if ($insert) {

        $_SESSION['success'] = "Customer added successfully.";

        header("Location: ../../admin/customers.php");
        exit();

    } else {

        $_SESSION['error'] = "Something went wrong.";

        header("Location: ../../admin/add-customer.php");
        exit();

    }

} else {

    header("Location: ../../admin/customers.php");
    exit();

}