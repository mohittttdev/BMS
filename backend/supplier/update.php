<?php

include("../connection.php");



if(isset($_POST['id'])){


    $id = $_POST['id'];

    $name = $_POST['name'];

    $company = $_POST['company'];

    $phone = $_POST['phone'];

    $email = $_POST['email'];

    $address = $_POST['address'];

    $status = $_POST['status'];





    $update = mysqli_query(

        $connection,

        "UPDATE suppliers SET


        name='$name',

        company='$company',

        phone='$phone',

        email='$email',

        address='$address',

        status='$status'


        WHERE id='$id'"

    );






    if($update){


        header("Location: ../../admin/suppliers.php");

        exit();



    }else{


        echo "Supplier Update Failed : "
        .mysqli_error($connection);



    }




}else{


    header("Location: ../../admin/suppliers.php");

    exit();


}



?>