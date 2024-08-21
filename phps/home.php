<?php
session_start();
if(!isset($_SESSION['username']))
{
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <?php require "../parts/bootstap_css.php"; ?>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
<?php require "../parts/nav.php"; ?>

<header>
        <h1>Welcome to Hospital Management System</h1>
    </header>
    <div class="container">
        <div class="intro">
            <p>Manage your hospital efficiently with our comprehensive Hospital Management System.</p>
        </div>
        <h2>Features</h2>
        <div class="features">
            <div class="feature">
                <h3>Add New Patients</h3>
                <p>you can add new paients.</p>
            </div>
            <div class="feature">
                <h3>Update old patients</h3>
                <p>Access and update patient records securely and conveniently.</p>
            </div>
            <div class="feature">
                <h3>Doctor's infomation</h3>
                <p>Access doctor's infomation! </p>
            </div>
        </div>
    </div>
   <?php require '../parts/footer.php'; ?>

<?php require "../parts/bootstap_js.php"; ?>
</body>
</html>
