<?php

include("../connection.php");



if(isset($_POST['name'])){



    $name = $_POST['name'];

    $email = $_POST['email'];

    $phone = $_POST['phone'];

    $address = $_POST['address'];

    $salary = $_POST['salary'];

    $joining_date = $_POST['joining_date'];

    $status = $_POST['status'];





    $query = mysqli_query(

        $connection,


        "INSERT INTO employees

        (

        name,

        email,

        phone,

        address,

        salary,

        joining_date,

        status

        )


        VALUES


        (

        '$name',

        '$email',

        '$phone',

        '$address',

        '$salary',

        '$joining_date',

        '$status'

        )"

    );







    if($query){


        header(

        "Location: ../../admin/employees.php"

        );


        exit();



    }

    else{


        echo "Employee Insert Failed";

    }






}

else{


    header(

    "Location: ../../admin/add-employee.php"

    );


    exit();


}



?>