<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['pass']))
{
    unset($_SESSION['username']);
    unset($_SESSION['pass']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logout</title>
    <?php require '../parts/bootstap_css.php'; ?>
</head>
<body>
    <?php require '../parts/nav.php'; ?>

    <div class='alert alert-success alert-dismissible fade show' role='success'>
  <strong>SuccessFully !</strong>  you are succesfully logout!
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>


    <?php require '../parts/bootstap_js.php'; ?>
</body>
</html>