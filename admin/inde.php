<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Example</title>
</head>
<body>

    <h1>Simple PHP + HTML Example</h1>

    <form method="POST">
        <input type="text" name="name" placeholder="Enter your Name" required>
        <input type="text" name="email" placeholder="Enter your Email" required>
        <button type="submit">Submit</button>
    </form>

    <?php
    if(isset($_POST['name'])){
        $name = htmlspecialchars($_POST['name']);
        echo "<h2>Welcome, $name!</h2>";
    }
    ?>

</body>
</html>