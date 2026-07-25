<?php

include("../connection.php");


if(isset($_POST['name'])){


    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $salary = mysqli_real_escape_string($connection, $_POST['salary']);
    $joining_data = mysqli_real_escape_string($connection, $_POST['joining_data']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);



    $query = mysqli_query(

        $connection,

        "INSERT INTO employees
        (
            name,
            email,
            phone,
            address,
            salary,
            joining_data,
            status
        )

        VALUES

        (
            '$name',
            '$email',
            '$phone',
            '$address',
            '$salary',
            '$joining_data',
            '$status'
        )"

    );



    if($query){


        header("Location: ../../admin/employees.php");

        exit();


    }
    else{


        die("Employee Insert Failed : ".mysqli_error($connection));


    }



}
else{


    header("Location: ../../admin/add-employee.php");

    exit();


}


?>