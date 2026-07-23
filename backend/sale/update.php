<?php

include("../connection.php");



if(isset($_POST['id'])){



    $id = $_POST['id'];

    $customer_id = $_POST['customer_id'];

    $invoice_no = $_POST['invoice_no'];

    $sale_date = $_POST['sale_date'];

    $total_amount = $_POST['total_amount'];

    $paid_amount = $_POST['paid_amount'];

    $due_amount = $_POST['due_amount'];

    $status = $_POST['status'];





    mysqli_begin_transaction($connection);





    try{





        // 1. Get Old Sale Items


        $oldItems = mysqli_query(

            $connection,

            "SELECT * FROM sale_items

             WHERE sale_id='$id'"

        );







        while($old=mysqli_fetch_assoc($oldItems)){



            $product_id = $old['product_id'];

            $quantity = $old['quantity'];






            // Return Old Stock


            mysqli_query(

                $connection,


                "UPDATE products

                 SET stock = stock + $quantity

                 WHERE id='$product_id'"

            );



        }








        // 2. Update Sale


        $update = mysqli_query(

            $connection,


            "UPDATE sales SET



            customer_id='$customer_id',

            invoice_no='$invoice_no',

            sale_date='$sale_date',

            total_amount='$total_amount',

            paid_amount='$paid_amount',

            due_amount='$due_amount',

            status='$status'



            WHERE id='$id'"

        );







        if(!$update){


            throw new Exception(
            "Sale Update Failed"
            );


        }








        // 3. Delete Old Items


        mysqli_query(

            $connection,


            "DELETE FROM sale_items

             WHERE sale_id='$id'"

        );








        // 4. Insert New Items


        foreach($_POST['product_id'] as $key=>$product_id){



            $quantity = $_POST['quantity'][$key];

            $price = $_POST['price'][$key];

            $total = $_POST['total'][$key];






            // Check Stock


            $check = mysqli_query(

                $connection,


                "SELECT stock FROM products

                 WHERE id='$product_id'"

            );



            $product = mysqli_fetch_assoc($check);






            if($product['stock'] < $quantity){


                throw new Exception(

                "Not Enough Stock"

                );


            }








            // Insert New Item


            $insert = mysqli_query(

                $connection,


                "INSERT INTO sale_items


                (

                sale_id,

                product_id,

                quantity,

                price,

                total

                )


                VALUES


                (

                '$id',

                '$product_id',

                '$quantity',

                '$price',

                '$total'

                )"

            );







            if(!$insert){


                throw new Exception(
                "Item Update Failed"
                );


            }







            // Minus New Stock


            mysqli_query(

                $connection,


                "UPDATE products


                 SET stock = stock - $quantity


                 WHERE id='$product_id'"

            );





        }








        mysqli_commit($connection);






        header(

        "Location: ../../admin/viewsale.php?id=".$id

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