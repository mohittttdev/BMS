<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include("../backend/connection.php");

// Fetch Settings
$query = mysqli_query($connection, "SELECT * FROM settings WHERE id='1'");
$setting = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>General Settings | Business Management System</title>

    <link rel="stylesheet" href="css/settings.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

</head>

<body>

<div class="wrapper">

    <!-- Sidebar -->
    <?php include("sidebar.php"); ?>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Header -->
        <div class="page-header">

            <div>

                <h2>
                    <i class="fa-solid fa-gear"></i>
                    General Settings
                </h2>

                <p>
                    Manage your business information and application settings.
                </p>

            </div>

        </div>

        <form action="../backend/settings/update.php"
              method="POST"
              enctype="multipart/form-data">

            <!-- ===================================== -->
            <!-- Company Information -->
            <!-- ===================================== -->

            <div class="card">

                <div class="card-header">

                    <i class="fa-solid fa-building"></i>

                    <span>Company Information</span>

                </div>

                <div class="card-body">

                    <div class="form-grid">

                        <div class="form-group">

                            <label>Company Name</label>

                            <input
                                type="text"
                                name="company_name"
                                value="<?= $setting['company_name']; ?>"
                                required>

                        </div>

                        <div class="form-group">

                            <label>Website Name</label>

                            <input
                                type="text"
                                name="site_name"
                                value="<?= $setting['site_name']; ?>">

                        </div>

                        <div class="form-group">

                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                value="<?= $setting['email']; ?>">

                        </div>

                        <div class="form-group">

                            <label>Phone Number</label>

                            <input
                                type="text"
                                name="phone"
                                value="<?= $setting['phone']; ?>">

                        </div>

                        <div class="form-group">

                            <label>GST Number</label>

                            <input
                                type="text"
                                name="gst_number"
                                value="<?= $setting['gst_number']; ?>">

                        </div>

                        <div class="form-group full">

                            <label>Company Address</label>

                            <textarea
                                name="address"
                                rows="4"><?= $setting['address']; ?></textarea>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ===================================== -->
            <!-- Branding -->
            <!-- ===================================== -->

            <div class="card">

                <div class="card-header">

                    <i class="fa-solid fa-palette"></i>

                    <span>Branding</span>

                </div>

                <div class="card-body">

                    <div class="form-grid">

                        <div class="form-group">

                            <label>Company Logo</label>

                            <?php if(!empty($setting['logo'])) { ?>

                                <div class="image-preview">

                                    <img src="../<?= $setting['logo']; ?>">

                                </div>

                            <?php } ?>

                            <input
                                type="file"
                                name="logo"
                                accept="image/*">

                        </div>

                        <div class="form-group">

                            <label>Favicon</label>

                            <?php if(!empty($setting['favicon'])) { ?>

                                <div class="image-preview">

                                    <img src="../<?= $setting['favicon']; ?>">

                                </div>

                            <?php } ?>

                            <input
                                type="file"
                                name="favicon"
                                accept="image/*">

                        </div>

                    </div>

                </div>

            </div>

            <!-- ===================================== -->
            <!-- Localization -->
            <!-- ===================================== -->

            <div class="card">

                <div class="card-header">

                    <i class="fa-solid fa-earth-asia"></i>

                    <span>Localization</span>

                </div>

                <div class="card-body">

                    <div class="form-grid">

                        <div class="form-group">

                            <label>Currency</label>

                            <select name="currency">

                                <option value="INR"
                                <?= ($setting['currency']=="INR")?"selected":""; ?>>
                                    ₹ INR
                                </option>

                                <option value="USD"
                                <?= ($setting['currency']=="USD")?"selected":""; ?>>
                                    $ USD
                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Time Zone</label>

                            <select name="timezone">

                                <option value="Asia/Kolkata"
                                <?= ($setting['timezone']=="Asia/Kolkata")?"selected":""; ?>>
                                    Asia/Kolkata
                                </option>

                                <option value="UTC"
                                <?= ($setting['timezone']=="UTC")?"selected":""; ?>>
                                    UTC
                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Date Format</label>

                            <select name="date_format">

                                <option value="d/m/Y">DD/MM/YYYY</option>

                                <option value="m/d/Y">MM/DD/YYYY</option>

                                <option value="Y-m-d">YYYY-MM-DD</option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ===================================== -->
            <!-- Theme -->
            <!-- ===================================== -->

            <div class="card">

                <div class="card-header">

                    <i class="fa-solid fa-brush"></i>

                    <span>Appearance</span>

                </div>

                <div class="card-body">

                    <div class="radio-group">

                        <label>

                            <input
                                type="radio"
                                name="theme"
                                value="light"
                                <?= ($setting['theme']=="light")?"checked":""; ?>>

                            Light Theme

                        </label>

                        <label>

                            <input
                                type="radio"
                                name="theme"
                                value="dark"
                                <?= ($setting['theme']=="dark")?"checked":""; ?>>

                            Dark Theme

                        </label>

                    </div>

                </div>

            </div>

            <!-- ===================================== -->
            <!-- Submit -->
            <!-- ===================================== -->

            <div class="submit-section">

                <button
                    type="submit"
                    class="save-btn">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Save Settings

                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>