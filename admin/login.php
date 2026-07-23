<?php
// session_start();

// if(isset($_SESSION['admin_id'])){
//     header("Location: index.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BMS Admin Login</title>

    <link rel="stylesheet" href="asset/css/login.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

<div class="login-container">

    <div class="login-card">

        <!-- Logo -->

        <div class="logo">

            <i class="fa-solid fa-chart-line"></i>

            <h2>BMS Admin</h2>

            <p>Business Management System</p>

        </div>


        <?php
if(isset($_SESSION['error'])){
?>
<div class="error-message">
    <?php
    echo $_SESSION['error'];
    unset($_SESSION['error']);
    ?>
</div>
<?php
}
?>

        <!-- Login Form -->

        <form action="../backend/login.php" method="POST">

            <div class="input-box">

                <label>Email</label>

                <div class="input-field">

                    <i class="fa-solid fa-envelope"></i>

                    <input
                    type="email"
                    name="email"
                    placeholder="Enter Email"
                    required>

                </div>

            </div>

            <div class="input-box">

                <label>Password</label>

                <div class="input-field">

                    <i class="fa-solid fa-lock"></i>

                    <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter Password"
                    required>

                    <span id="togglePassword">

                        <i class="fa-solid fa-eye"></i>

                    </span>

                </div>

            </div>

            <div class="login-option">

                <label>

                    <input type="checkbox">

                    Remember Me

                </label>

                <a href="#">Forgot Password?</a>

            </div>

            <button type="submit" class="login-btn">

                Login

            </button>

        </form>

    </div>

</div>

<script>

const password=document.getElementById("password");

const toggle=document.getElementById("togglePassword");

toggle.onclick=function(){

    if(password.type==="password"){

        password.type="text";

        toggle.innerHTML='<i class="fa-solid fa-eye-slash"></i>';

    }else{

        password.type="password";

        toggle.innerHTML='<i class="fa-solid fa-eye"></i>';

    }

}

</script>

</body>
</html>