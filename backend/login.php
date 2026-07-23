<?php
session_start();

include "connection.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $password = md5($_POST['password']);

    $query = mysqli_query($connection, "
        SELECT *
        FROM admin
        WHERE email='$email'
        AND password='$password'
        AND status='Active'
        LIMIT 1
    ");

    if (mysqli_num_rows($query) == 1) {

        $admin = mysqli_fetch_assoc($query);

        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        $_SESSION['admin_email'] = $admin['email'];

        header("Location: ../admin/index.php");
        exit();

    } else {

        $_SESSION['error'] = "Invalid Email or Password!";
        header("Location: ../admin/login.php");
        exit();

    }

} else {

    header("Location: ../admin/login.php");
    exit();

}
?>