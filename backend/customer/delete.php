<?php

session_start();

include("../connection.php");


// Check ID

if(isset($_GET['id'])){


    $id = mysqli_real_escape_string($connection,$_GET['id']);



    // Check Customer Exists

    $check = mysqli_query(
        $connection,
        "SELECT id FROM customer WHERE id='$id'"
    );


    if(mysqli_num_rows($check) == 0){


        $_SESSION['error']="Customer not found.";

        header("Location: ../../admin/customers.php");

        exit();

    }



    // Delete Customer

    $delete = mysqli_query(
        $connection,
        "DELETE FROM customer WHERE id='$id'"
    );



    if($delete){


        $_SESSION['success']="Customer deleted successfully.";


    }else{


        $_SESSION['error']="Unable to delete customer.";


    }



    header("Location: ../../admin/customers.php");

    exit();



}else{


    $_SESSION['error']="Invalid request.";

    header("Location: ../../admin/customers.php");

    exit();


}


?>