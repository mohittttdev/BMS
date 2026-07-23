<?php

include("../connection.php");



if(isset($_GET['id'])){



    $id = $_GET['id'];





    $query = mysqli_query(

        $connection,


        "DELETE FROM employees 

         WHERE id='$id'"

    );






    if($query){


        header(

        "Location: ../../admin/employees.php"

        );


        exit();



    }

    else{


        echo "Employee Delete Failed";


    }





}

else{


    header(

    "Location: ../../admin/employees.php"

    );


    exit();


}



?>