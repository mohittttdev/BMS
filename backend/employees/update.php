<?php
include("../connection.php");

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $joining_data = $_POST['joining_data'];
    $status = $_POST['status'];




    $query = mysqli_query(

        $connection,


        "UPDATE employees SET


        name='$name',

        email='$email',

        phone='$phone',

        address='$address',

        salary='$salary',

      joining_data='$joining_data',

        status='$status'


        WHERE id='$id'"

    );







    if($query){


        header(

        "Location: ../../admin/employees.php"

        );


        exit();



    }

    else{


        echo "Employee Update Failed";


    }




}

else{


    header(

    "Location: ../../admin/employees.php"

    );


    exit();


}



?>