<?php

include("../connection.php");



if(isset($_GET['id'])){


    $id = $_GET['id'];



    // Delete Supplier

    $delete = mysqli_query(

        $connection,

        "DELETE FROM suppliers WHERE id='$id'"

    );





    if($delete){


        header("Location: ../../admin/suppliers.php");

        exit();



    }else{


        echo "Supplier Delete Failed : "
        .mysqli_error($connection);



    }




}else{


    header("Location: ../../admin/suppliers.php");

    exit();


}



?>