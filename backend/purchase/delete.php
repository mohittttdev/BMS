<?php

include("../connection.php");



if(isset($_GET['id'])){


    $id = $_GET['id'];



    mysqli_begin_transaction($connection);



    try {



        // Get Purchase Items

        $items = mysqli_query(

            $connection,

            "SELECT * FROM purchase_items 
             WHERE purchase_id='$id'"

        );





        while($row = mysqli_fetch_assoc($items)){



            $product_id = $row['product_id'];

            $quantity = $row['quantity'];





            // Reduce Stock Back


            $stock = mysqli_query(

                $connection,

                "UPDATE products

                SET stock = stock - $quantity

                WHERE id='$product_id'"

            );




            if(!$stock){

                throw new Exception("Stock Update Failed");

            }



        }







        // Delete Purchase Items


        $deleteItems = mysqli_query(

            $connection,

            "DELETE FROM purchase_items 
             WHERE purchase_id='$id'"

        );





        if(!$deleteItems){

            throw new Exception("Items Delete Failed");

        }







        // Delete Purchase


        $deletePurchase = mysqli_query(

            $connection,

            "DELETE FROM purchases 
             WHERE id='$id'"

        );





        if(!$deletePurchase){

            throw new Exception("Purchase Delete Failed");

        }







        mysqli_commit($connection);



        header("Location: ../../admin/purchases.php");

        exit();





    }catch(Exception $e){



        mysqli_rollback($connection);


        echo $e->getMessage();


    }





}else{


    header("Location: ../../admin/purchases.php");

    exit();


}



?>