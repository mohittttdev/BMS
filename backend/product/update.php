<?php

include("../connection.php");


if(isset($_POST['id'])){


    $id = $_POST['id'];

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





    // Old Product Image

    $oldImageQuery = mysqli_query(
        $connection,
        "SELECT image FROM products WHERE id='$id'"
    );


    $oldImageData = mysqli_fetch_assoc($oldImageQuery);


    $image = $oldImageData['image'];







    // New Image Upload


    if(isset($_FILES['image']) && $_FILES['image']['name']!=""){



        $imageName = time()."_".$_FILES['image']['name'];


        $tmpName = $_FILES['image']['tmp_name'];


        $uploadPath = "../../admin/uploads/".$imageName;



        move_uploaded_file(
            $tmpName,
            $uploadPath
        );



        // Delete old image


        if($image!="" && file_exists("../../admin/uploads/".$image)){


            unlink("../../admin/uploads/".$image);


        }



        $image = $imageName;



    }








    // Update Query


    $update = mysqli_query(

        $connection,


        "UPDATE products SET


        product_code='$product_code',

        product_name='$product_name',

        category='$category',

        brand='$brand',

        supplier='$supplier',

        purchase_price='$purchase_price',

        selling_price='$selling_price',

        stock_quantity='$stock_quantity',

        unit='$unit',

        gst='$gst',

        description='$description',

        image='$image',

        status='$status'


        WHERE id='$id'"

    );







    if($update){


        header("Location: ../../admin/product.php");

        exit();



    }else{


        echo "Update Failed : "
        .mysqli_error($connection);



    }




}



?>