<?php

include("../connection.php");



if(isset($_GET['id'])){



    $id = $_GET['id'];



    mysqli_begin_transaction($connection);



    try{





        // Get Sale Items


        $items = mysqli_query(

            $connection,

            "SELECT * FROM sale_items

             WHERE sale_id='$id'"

        );







        while($row = mysqli_fetch_assoc($items)){



            $product_id = $row['product_id'];

            $quantity = $row['quantity'];






            // Return Stock Back


            $stock = mysqli_query(

                $connection,


                "UPDATE products


                 SET stock = stock + $quantity


                 WHERE id='$product_id'"

            );






            if(!$stock){


                throw new Exception(
                "Stock Update Failed"
                );


            }



        }








        // Delete Sale Items


        $deleteItems = mysqli_query(

            $connection,


            "DELETE FROM sale_items

             WHERE sale_id='$id'"

        );







        if(!$deleteItems){


            throw new Exception(
            "Sale Items Delete Failed"
            );


        }








        // Delete Sale


        $deleteSale = mysqli_query(

            $connection,


            "DELETE FROM sales

             WHERE id='$id'"

        );







        if(!$deleteSale){


            throw new Exception(
            "Sale Delete Failed"
            );


        }








        mysqli_commit($connection);







        header(

        "Location: ../../admin/sales.php"

        );


        exit();







    }catch(Exception $e){



        mysqli_rollback($connection);



        echo $e->getMessage();



    }





}else{



    header(

    "Location: ../../admin/sales.php"

    );


    exit();


}



?>