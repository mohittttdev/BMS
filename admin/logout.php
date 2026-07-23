<?php

session_start();

// Sabhi session variables remove karo
$_SESSION = [];

// Session destroy karo
session_destroy();

// Browser cookie bhi remove karo (agar session cookie use ho rahi ho)
if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Login page par redirect
header("Location: login.php");
exit();

?>