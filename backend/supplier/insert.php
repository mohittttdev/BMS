<?php

include("../connection.php");


if(isset($_POST['name'])){


    $name = $_POST['name'];

    $company = $_POST['company'];

    $phone = $_POST['phone'];

    $email = $_POST['email'];

    $address = $_POST['address'];

    $status = $_POST['status'];




    $query = mysqli_query(

        $connection,

        "INSERT INTO suppliers
        (
            name,
            company,
            phone,
            email,
            address,
            status
        )

        VALUES

        (
            '$name',
            '$company',
            '$phone',
            '$email',
            '$address',
            '$status'
        )"

    );





    if($query){


        header("Location: ../../admin/suppliers.php");

        exit();



    }else{


        echo "Supplier Insert Failed : "
        .mysqli_error($connection);



    }



}else{


    header("Location: ../../admin/addsupplier.php");

    exit();



}


?>