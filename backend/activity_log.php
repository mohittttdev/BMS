<?php

include("connection.php");

function addActivity($module, $action, $message, $user_id = 1)
{

    global $connection;

    $module = mysqli_real_escape_string($connection, $module);
    $action = mysqli_real_escape_string($connection, $action);
    $message = mysqli_real_escape_string($connection, $message);
    $user_id = mysqli_real_escape_string($connection, $user_id);


    $query = mysqli_query(
        $connection,
        "INSERT INTO activity_logs 
        (module, action, message, user_id)
        VALUES
        ('$module','$action','$message','$user_id')"
    );


    return $query;
}

?>