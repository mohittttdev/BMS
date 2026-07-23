<?php

session_start();

include("connection.php");


if($_SERVER["REQUEST_METHOD"]=="POST"){


    $email = $_POST['email'];

    $password = $_POST['password'];



    $query = mysqli_query(
        $connection,
        "SELECT * FROM admin WHERE email='$email'"
    );



    if(mysqli_num_rows($query)>0){


        $admin = mysqli_fetch_assoc($query);



        if($password == $admin['password']){


            $_SESSION['admin_id'] = $admin['id'];

            $_SESSION['admin_name'] = $admin['name'];

            $_SESSION['admin_email'] = $admin['email'];



            header("Location: ../admin/dash.php");

            exit();



        }else{


            $_SESSION['error']="Wrong Password";

            header("Location: ../admin/login.php");

            exit();

        }



    }else{


        $_SESSION['error']="Email not found";

        header("Location: ../admin/login.php");

        exit();


    }


}


?>