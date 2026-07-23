<?php

include("../connection.php");



if(isset($_POST['supplier_id'])){



    $supplier_id = $_POST['supplier_id'];

    $invoice_no = $_POST['invoice_no'];

    $purchase_date = $_POST['purchase_date'];

    $total_amount = $_POST['total_amount'];

    $paid_amount = $_POST['paid_amount'];

    $due_amount = $_POST['due_amount'];

    $status = $_POST['status'];





    mysqli_begin_transaction($connection);



    try {



        // Insert Purchase


        $purchase = mysqli_query(

            $connection,

            "INSERT INTO purchases
            (
                supplier_id,
                invoice_no,
                purchase_date,
                total_amount,
                paid_amount,
                due_amount,
                status
            )

            VALUES

            (
                '$supplier_id',
                '$invoice_no',
                '$purchase_date',
                '$total_amount',
                '$paid_amount',
                '$due_amount',
                '$status'
            )"

        );




        if(!$purchase){

            throw new Exception("Purchase Insert Failed");

        }





        $purchase_id = mysqli_insert_id($connection);





        // Product Items


        foreach($_POST['product_id'] as $key=>$product_id){



            $quantity = $_POST['quantity'][$key];

            $price = $_POST['price'][$key];

            $total = $_POST['total'][$key];





            // Insert Purchase Items


            $item = mysqli_query(

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
                    '$purchase_id',
                    '$product_id',
                    '$quantity',
                    '$price',
                    '$total'
                )"

            );





            if(!$item){

                throw new Exception("Item Insert Failed");

            }





            // Update Product Stock

$stock = mysqli_query(

    $connection,

    "UPDATE products

    SET stock = stock + $quantity

    WHERE id='$product_id'"

);




            if(!$stock){

                throw new Exception("Stock Update Failed");

            }




        }






        mysqli_commit($connection);



        header("Location: ../../admin/purchases.php");

        exit();





    } catch(Exception $e){



        mysqli_rollback($connection);



        echo $e->getMessage();



    }





}else{


    header("Location: ../../admin/addpurchase.php");

    exit();


}



?>