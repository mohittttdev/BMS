<?php

session_start();

include("../connection.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){


    $id = mysqli_real_escape_string($connection,$_POST['id']);

    $customer_code = mysqli_real_escape_string($connection,$_POST['customer_code']);

    $customer_name = mysqli_real_escape_string($connection,$_POST['customer_name']);

    $company_name = mysqli_real_escape_string($connection,$_POST['company_name']);

    $email = mysqli_real_escape_string($connection,$_POST['email']);

    $phone = mysqli_real_escape_string($connection,$_POST['phone']);

    $alternate_phone = mysqli_real_escape_string($connection,$_POST['alternate_phone']);

    $gender = mysqli_real_escape_string($connection,$_POST['gender']);

    $dob = mysqli_real_escape_string($connection,$_POST['dob']);

    $gst_number = mysqli_real_escape_string($connection,$_POST['gst_number']);

    $pan_number = mysqli_real_escape_string($connection,$_POST['pan_number']);

    $address = mysqli_real_escape_string($connection,$_POST['address']);

    $city = mysqli_real_escape_string($connection,$_POST['city']);

    $state = mysqli_real_escape_string($connection,$_POST['state']);

    $country = mysqli_real_escape_string($connection,$_POST['country']);

    $pincode = mysqli_real_escape_string($connection,$_POST['pincode']);

    $opening_balance = mysqli_real_escape_string($connection,$_POST['opening_balance']);

    $credit_limit = mysqli_real_escape_string($connection,$_POST['credit_limit']);

    $status = mysqli_real_escape_string($connection,$_POST['status']);



    // Duplicate Check

    $check = mysqli_query(
        $connection,
        "SELECT id FROM customer
         WHERE (email='$email' OR phone='$phone')
         AND id!='$id'"
    );


    if(mysqli_num_rows($check)>0){


        $_SESSION['error']="Email or Phone already exists.";


        header("Location: ../../admin/editcustomer.php?id=".$id);

        exit();


    }



    // Update Query

    $update = mysqli_query($connection,

    "UPDATE customers SET

        customer_code='$customer_code',

        customer_name='$customer_name',

        company_name='$company_name',

        email='$email',

        phone='$phone',

        alternate_phone='$alternate_phone',

        gender='$gender',

        dob='$dob',

        gst_number='$gst_number',

        pan_number='$pan_number',

        address='$address',

        city='$city',

        state='$state',

        country='$country',

        pincode='$pincode',

        opening_balance='$opening_balance',

        credit_limit='$credit_limit',

        status='$status'


    WHERE id='$id'"

    );



    if($update){


        $_SESSION['success']="Customer updated successfully.";


        header("Location: ../../admin/customer.php");

        exit();



    }else{


        $_SESSION['error']="Failed to update customer.";


        header("Location: ../../admin/editcustomer.php?id=".$id);

        exit();


    }



}else{


    header("Location: ../../admin/customer.php");

    exit();


}

?>