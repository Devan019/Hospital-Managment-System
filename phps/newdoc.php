<?php
$warn = 0;
session_start();
if (!isset($_SESSION['username'])) {
    header('location:index.php');
}
require '../parts/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $edu = $_POST['edu'];
        $sp = $_POST['sp'];
        $no = $_POST['cno'];
        $time = $_POST['timing'];

        $nu = filter_var($no, FILTER_VALIDATE_INT);

        $c = 0;
        for ($i = 0; $i < strlen($no); $i++) {
            if ($no[$i] >= 0 && $no[$i] <= 9) {
                $c++;
            }
        }

        if ($c != 10 || $nu < 0 || $nu == '') {
            $warn = 1;
        } else {

            $sql = "INSERT INTO `doctor` (`doctor_name`, `education`,`specialty`, `doctor_no`, `timing`) VALUES ('$name','$edu', '$sp', '$no', '$time')";
            // echo $i. "<br>";
            $r = mysqli_query($link, $sql);
            if ($r) {
                header('location:doctor.php');
            } else {
                echo "sorry!";
            }
        }
    }
}
if ($warn) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='danger'>
    <strong>WARN!</strong> Doctor's phone no is not valid!
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
        [type=submit]:not(:disabled),
        button:not(:disabled) {
            cursor: pointer;
            margin: 10px;
        }
    </style>
</head>

<body>
    <?php require '../parts/nav.php'; ?>
    <h3>Add New Doctor</h3>
    <!-- Your form content goes here -->
    <div class="new">
        <form method='post' action='#'>
            <lable for="name">Name:-</lable>
            <input type="text" id="name" name="name" required>

            <lable for="edu">Education</lable>
            <input type="text" id="edu" name="edu" required>

            <lable for="sp">Specialty</lable>
            <input type="text" id="sp" name="sp" required>

            <lable for="phone">Contant_no:-</lable>
            <input type="text" id="phone" name="cno" required>



            <lable for="timing">timing</lable>
            <input type="text" id="timing" name="timing" required>
            <button type="submit" class="btn btn-primary add-doc" id='add' name='add'>Add Doctor</button>

        </form>
    </div>



    <?php require "../parts/bootstap_js.php"; ?>
    <script src="../parts/doctor.js"></script>

    <?php require '../parts/footer.php'; ?>
</body>

</html>