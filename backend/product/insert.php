<?php

include("../connection.php");


// Check Form Submit

if(isset($_POST['product_name'])){


    $product_code = $_POST['product_code'];

    $product_name = $_POST['product_name'];

    $category = $_POST['category'];

    $brand = $_POST['brand'];

    $supplier = $_POST['supplier'];

    $purchase_price = $_POST['purchase_price'];

    $selling_price = $_POST['selling_price'];

    $stock_quantity = $_POST['stock_quantity'];

    $unit = $_POST['unit'];

    $gst = $_POST['gst'];

    $description = $_POST['description'];

    $status = $_POST['status'];





    // Image Upload


    $image = "";


    if(isset($_FILES['image']) && $_FILES['image']['name']!=""){


        $imageName = time()."_".$_FILES['image']['name'];


        $tmpName = $_FILES['image']['tmp_name'];


        $uploadPath = "../../admin/uploads/products/".$imageName;



        move_uploaded_file(
            $tmpName,
            $uploadPath
        );


        $image = $imageName;


    }






    // Insert Query


    $query = mysqli_query(
        $connection,

        "INSERT INTO products
        (
        product_code,
        product_name,
        category,
        brand,
        supplier,
        purchase_price,
        selling_price,
        stock_quantity,
        unit,
        gst,
        description,
        image,
        status
        )

        VALUES

        (
        '$product_code',
        '$product_name',
        '$category',
        '$brand',
        '$supplier',
        '$purchase_price',
        '$selling_price',
        '$stock_quantity',
        '$unit',
        '$gst',
        '$description',
        '$image',
        '$status'
        )"

    );






    if($query){


        header("Location: ../../admin/products.php");

        exit();



    }else{


        echo "Product Insert Failed : "
        .mysqli_error($connection);


    }



}


?>