<?php

include("../connection.php");



if(isset($_GET['id'])){


    $id = $_GET['id'];



    // Get Product Image

    $imageQuery = mysqli_query(
        $connection,
        "SELECT image FROM products WHERE id='$id'"
    );


    $product = mysqli_fetch_assoc($imageQuery);



    // Delete Image From Folder

    if($product['image'] != ""){


        $imagePath = "../../admin/uploads/".$product['image'];



        if(file_exists($imagePath)){


            unlink($imagePath);


        }


    }




    // Delete Product

    $delete = mysqli_query(

        $connection,

        "DELETE FROM products WHERE id='$id'"

    );





    if($delete){


        header("Location: ../../admin/product.php");

        exit();


    }else{


        echo "Delete Failed : "
        .mysqli_error($connection);


    }



}else{


    header("Location: ../../admin/product.php");

    exit();


}



?>