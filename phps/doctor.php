<?php require '../parts/db.php';
session_start();
if (!isset($_SESSION['username'])) {
  header('location:index.php');
}
?>

<?php
$warn = false;
$sdelete = false;
$supdate = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['up'])) {
    $id = $_POST['noof'];
    // $name = $_POST['name'];
    $edu = $_POST['edu'];
    $sp = $_POST['sp'];
    $no = $_POST['cno'];
    $time = $_POST['timing'];

    $c = 0;
    for ($i = 0; $i < strlen($no); $i++) {
      if ($no[$i] >= 0 && $no[$i] <= 9) {
        $c++;
      }
    }
    if ($c != 10) {
      $warn = true;
    } else {

      $update = "UPDATE `doctor` SET `education`='$edu',`specialty` = '$sp' ,`doctor_no`='$no',`timing`='$time' WHERE `sr.no` = '$id'";
      $result = mysqli_query($link, $update);
      if ($result) {
        $supdate = true;
      }
      // else
      // {
      //   echo "op";
      // }
    }
  } else if (isset($_POST['delete'])) {

    $id = $_POST['id'];
    // echo $id . "<br>";
    $delete = "DELETE FROM `doctor` WHERE `sr.no` = '$id'";
    // echo $delete;

    $result = mysqli_query($link, $delete);
    if ($result) {

      // echo $result;
      $sdelete = true;
    } else {
      echo "pioip";
    }
  } else if (isset($_POST['info'])) {
    $id = $_POST['info'];
    echo $id;
    session_start();
    $_SESSION['name'] = $id;
    header('location:staff.php');
  } else {
    echo "pi";
  }
}



?>
<?php
if ($sdelete) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='success'>
  <strong>SuccessFully !</strong>  doctor's details will be deleted!
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
if ($supdate) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='success'>
    <strong>Congratulation!</strong> doctor's details will be updated!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
if ($warn) {
  echo "<div class='alert alert-danger alert-dismissible fade show' role='danger'>
    <strong>WARN!</strong> doctor's phone no is not valid!
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
  <?php require "../parts/bootstap_css.php"; ?>
  <style>
    [type=submit]:not(:disabled),
    button:not(:disabled) {
      cursor: pointer;
      margin: 10px;
    }

    a button {
      position: relative;
      left: 85vw;
    }
  </style>
</head>

<body>
  <?php require "../parts/nav.php"; ?>

  <h2>list of Doctors</h2>
  <div class='tableof'>
    <table class="table" id="myTable">
      <thead>
        <tr>

          <th>Sr.no</th>
          <th>Name</th>
          <th>education</th>
          <th>Specialty</th>
          <th>doctor_no</th>
          <th>timing</th>
          <th></th>

        </tr>
      </thead>
      <tbody>
        <?php
        $read = "SELECT * FROM `doctor`";
        $result = mysqli_query($link, $read);
        $i = 1;
        while ($data = mysqli_fetch_assoc($result)) {


          echo "<tr>";

          echo "<td> " . $i . " </td>";
          echo "<td>" . $data['doctor_name'] . " </td>";
          echo "<td>" . $data['education'] . " </td>";
          echo "<td>" . $data['specialty'] . " </td>";
          echo "<td>" . $data['doctor_no'] . " </td>";
          echo "<td>" . $data['timing'] . " </td>";
          echo "<form action='doctor.php' method='post'>";
          echo "<td><button type='submit'   value =  " . $data['doctor_name'] . " name = 'info' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#infoModal'>Staff info</button>";
          echo "</form>";
          echo "<button type='button'  id=  " . $data['sr.no'] . " name = 'up' class='btn btn-primary update' data-bs-toggle='modal' data-bs-target='#updateModal'>Update</button>";
          echo "<button type='button'  id=  " . $data['sr.no'] . " name = 'delete' class='btn btn-warning dels' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button>  </td>";

          echo "</tr>";
          $i = $i + 1;
        }
        ?>
      </tbody>
    </table>
  </div>



  <!--modal for update-->

  <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Upadate doctor's details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="doctor.php" method='post'>
            <input type="hidden" name="noof" id="noof">
            <!-- Your form content goes here -->
            <div class="info">
              <lable for="name">Name:-</lable>
              <input type="text" id="name" name="name">

              <lable for="edu">Education</lable>
              <input type="text" id="edu" name="edu">


              <lable for="sp">Specialty</lable>
              <input type="text" id="sp" name="sp">

              <lable for="phone">Contant_no:-</lable>
              <input type="text" id="phone" name="cno">

              <lable for="timing">timing</lable>
              <input type="text" id="timing" name="timing">


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" name='close' data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name='up' data-bs-dismiss="modal">update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--modal for delete-->
  <!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete Doctor's details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="doctor.php" method='post'>
            <input type="hidden" name='id' id='id'>
            <div>confirm delete to doctor</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name='delete'>delete</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <a href="newdoc.php"><button type="button" class="btn btn-primary">Add Doctor</button></a>


  <?php require '../parts/footer.php'; ?>
  <?php require "../parts/bootstap_js.php"; ?>


  <script>
    let allup = document.querySelectorAll(".update");
  </script>


  <script src="../parts/doctor.js"></script>
</body>

</html>