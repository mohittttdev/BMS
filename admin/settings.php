<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}
include("../backend/connection.php");

// Fetch settings
$result = mysqli_query($connection,"SELECT * FROM settings LIMIT 1");
$settings = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Settings - BMS</title>
<link rel="stylesheet" href="asset/css/index.css">
<link rel="stylesheet" href="asset/css/settings.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
<div class="container">
<aside class="sidebar">
<div class="logo"><i class="fa-solid fa-chart-line"></i><h2>BMS</h2></div>
<ul>
<li><a href="index.php"><i class="fa-solid fa-house"></i>Dashboard</a></li>
<li class="active"><a href="settings.php"><i class="fa-solid fa-gear"></i>Settings</a></li>
<li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
</ul>
</aside>

<main class="main">
<header class="topbar">
<h2>Settings</h2>
<div class="profile">
<strong><?php echo $_SESSION['admin_name']; ?></strong>
</div>
</header>

<div class="table-card">
<h3>Company Information</h3>

<form action="../backend/update_settings.php" method="POST" enctype="multipart/form-data">

<label>Company Name</label>
<input type="text" name="company_name" value="<?php echo htmlspecialchars($settings['company_name'] ?? ''); ?>">

<label>Email</label>
<input type="email" name="company_email" value="<?php echo htmlspecialchars($settings['company_email'] ?? ''); ?>">

<label>Phone</label>
<input type="text" name="company_phone" value="<?php echo htmlspecialchars($settings['company_phone'] ?? ''); ?>">

<label>Address</label>
<textarea name="company_address"><?php echo htmlspecialchars($settings['company_address'] ?? ''); ?></textarea>

<label>Currency</label>
<input type="text" name="currency" value="<?php echo htmlspecialchars($settings['currency'] ?? '₹'); ?>">

<label>Timezone</label>
<input type="text" name="timezone" value="<?php echo htmlspecialchars($settings['timezone'] ?? 'Asia/Kolkata'); ?>">

<label>Company Logo</label>
<input type="file" name="company_logo">

<?php if(!empty($settings['company_logo'])): ?>
<p><img src="../uploads/logo/<?php echo $settings['company_logo']; ?>" style="max-height:80px"></p>
<?php endif; ?>

<hr>

<h3>Change Password</h3>

<label>Current Password</label>
<input type="password" name="current_password">

<label>New Password</label>
<input type="password" name="new_password">

<label>Confirm Password</label>
<input type="password" name="confirm_password">

<button type="submit">Save Changes</button>

</form>

</div>
</main>
</div>
</body>
</html>