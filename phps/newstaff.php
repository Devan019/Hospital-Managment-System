<?php
session_start();
$warn  = false;
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
require '../parts/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {

        $doc = $_SESSION['name'];

        $name = $_POST['name'];
        $no =  $_POST['no'];
        $pos = $_POST['pos'];
        $nu = filter_var($no, FILTER_VALIDATE_INT);

        // if ($nu) {
        //     $warn = true;
          {
            $sql = "INSERT INTO `staff`(`doctor_name`,`member_name`, `contact_no`, `position`) VALUES ('$doc','$name','$no','$pos') ";
            // echo $i. "<br>";
            $r = mysqli_query($link, $sql);
            if ($r) {
                header('location:staff.php');
            } else {
                // echo "sorry!";
            }
        }
    }
}
if ($warn) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='danger'>
    <strong>WARN!</strong> staff's phone no is not valid!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/new.css">
    <?php require "../parts/bootstap_css.php"; ?>
    <style>
        a button {
            position: absolute;
            right: 0;
            bottom: 40vh;


        }
    </style>
</head>

<body>
    <?php require '../parts/nav.php'; ?>

    <h3>Add New Staff member</h3>
    <!-- Your form content goes here -->
    <div class="new">
        <form method='post' action=''>
            <lable for="name">Member_name</lable>
            <input type="text" id="name" name="name" required><br>

            <lable for="phone">contact_no</lable>
            <input type="text" id="phone" name="no" required><br>

            <lable for="pos">Position:-</lable>
            <input type="text" id="pos" name="pos" required><br>



            <button type="submit" id='add' name='add'>Add Staff member</button>
        </form>
    </div>

    <?php require "../parts/bootstap_js.php"; ?>


    <?php require '../parts/footer.php'; ?>
</body>

</html>