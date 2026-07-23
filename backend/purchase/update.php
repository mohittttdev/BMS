<?php

include("../connection.php");


if(isset($_POST['id'])){


    $id = $_POST['id'];

    $supplier_id = $_POST['supplier_id'];

    $invoice_no = $_POST['invoice_no'];

    $purchase_date = $_POST['purchase_date'];

    $total_amount = $_POST['total_amount'];

    $paid_amount = $_POST['paid_amount'];

    $due_amount = $_POST['due_amount'];

    $status = $_POST['status'];



    mysqli_begin_transaction($connection);



    try{


        // 1. Get Old Purchase Items

        $oldItems = mysqli_query(

            $connection,

            "SELECT * FROM purchase_items
             WHERE purchase_id='$id'"

        );



        while($old = mysqli_fetch_assoc($oldItems)){


            $product_id = $old['product_id'];

            $quantity = $old['quantity'];



            // Reverse Old Stock

            mysqli_query(

                $connection,

                "UPDATE products
                 SET stock = stock - $quantity
                 WHERE id='$product_id'"

            );


        }





        // 2. Update Purchase


        $update = mysqli_query(

            $connection,

            "UPDATE purchases SET


            supplier_id='$supplier_id',

            invoice_no='$invoice_no',

            purchase_date='$purchase_date',

            total_amount='$total_amount',

            paid_amount='$paid_amount',

            due_amount='$due_amount',

            status='$status'


            WHERE id='$id'"

        );



        if(!$update){

            throw new Exception("Purchase Update Failed");

        }





        // 3. Delete Old Items


        mysqli_query(

            $connection,

            "DELETE FROM purchase_items
             WHERE purchase_id='$id'"

        );






        // 4. Insert New Items


        foreach($_POST['product_id'] as $key=>$product_id){



            $quantity = $_POST['quantity'][$key];

            $price = $_POST['price'][$key];

            $total = $_POST['total'][$key];





            $insertItem = mysqli_query(

                $connection,

                "INSERT INTO purchase_items

                (
                    purchase_id,
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



            if(!$insertItem){

                throw new Exception("Item Update Failed");

            }







            // Add New Stock


            mysqli_query(

                $connection,

                "UPDATE products

                SET stock = stock + $quantity

                WHERE id='$product_id'"

            );



        }






        mysqli_commit($connection);




        header("Location: ../../admin/view-purchase.php?id=".$id);

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