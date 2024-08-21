<?php require "../parts/db.php"; ?>
<?php
session_start();
if(!isset($_SESSION['username']))
{
  header('location:index.php');
}
$sdelete = false;
$supdate = false;
 $PHONE = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Always execute the database query
    if (isset($_POST['up']))
  {
    $id = $_POST['noof'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $no = $_POST['cno'];
    $add = $_POST['address'];
    $doctor = $_POST['doctor'];
    $dis = $_POST['disease'];
    $med = $_POST['medicines'];
    $room = $_POST['room_no'];
 
   
    $c = 0;
    for($i = 0 ; $i < strlen($no) ; $i++)
    {
      if($no[$i] >= 0 && $no[$i] <= 9 )
      {
      $c++;
      }
    }
  if($c != 10)
  {
      $PHONE = true;
  
  }
    else
    {
      $update = "UPDATE `patients` SET `name`='$name',`phone`='$no',`age`='$age',`address`='$add',`doctor_name`='$doctor',`disease`='$dis',`medicines`='$med',`room_no`='$room' WHERE `sr.no` = '$id'";
      $up = mysqli_query($link, $update);
      if($up)
      {
        $supdate = true;
      }
    }
  }

    else if(isset($_POST['delete']))
    {
        $id = $_POST['del'];
        $deleteq = "DELETE FROM `patients` where `sr.no` = '$id'";
        $result = mysqli_query($link , $deleteq);
        if($result)
        {
          $sdelete = true;
        }
    }
    else
    {
       echo "op";
    }
}

?>
<?php
if($sdelete)
{
  echo "<div class='alert alert-success alert-dismissible fade show' role='success'>
  <strong>SuccessFully !</strong>  Paitent's details will be deleted!
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
if($supdate)
{
  echo "<div class='alert alert-success alert-dismissible fade show' role='success'>
    <strong>Congratulation!</strong> Paitent's details will be updated!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
if($PHONE)
{
  echo "<div class='alert alert-danger alert-dismissible fade show' role='danger'>
    <strong>WARN!</strong> Paitent's phone no is not valid!
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
        [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: pointer;
    margin: 10px;
}
    </style>
</head>
<body>
<?php require "../parts/nav.php"; ?>
<h2>list of Old_Patients</h2>
<div class='tableof'>
<table class="table" id="myTable">
  <thead>
    <tr>
    
      <th>Sr.no</th>
      <th>Name</th>
      <th>Age</th>
      <th>contant_no</th>
      <th>address</th>
      <th>Doctor's name</th>
      <th>Disease</th>
      <th>medicines</th>
    <th>room_no</th>
      <th></th>
      
    </tr>
  </thead>
  <tbody>
    <?php
        $read = "SELECT * FROM `patients`";
        $result = mysqli_query($link , $read);
        $i = 1;
        while($data = mysqli_fetch_assoc($result))
        {
           
            echo "<tr>";
            
            echo "<td> " . $i . " </td>";
            echo "<td>" . $data['name'] . " </td>";
            echo "<td>" . $data['age'] . " </td>";
            echo "<td>" . $data['phone'] . " </td>";
            echo "<td>" . $data['address'] . " </td>";
            
            echo "<td>" . $data['doctor_name'] . " </td>";
            echo "<td>" . $data['disease'] . " </td>";
            echo "<td class>" . $data['medicines'] . " </td>";
            echo "<td class>" . $data['room_no'] . " </td>";

            echo "<td><button type='submit'  id=  ".$data['sr.no']. " name = 'up' class='btn btn-primary update' data-bs-toggle='modal' data-bs-target='#infoModal'>Update</button>";
            echo "<button type='button'  id=  ".$data['sr.no']. " name = 'delete' class='btn btn-warning DEL' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button>  </td>";
            
            echo "</tr>";
            $i = $i + 1;
        }
    ?>
  </tbody>
</table>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<!-- //modal of add -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">About Patient</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form action="old.php" method='post'>
                <input type="hidden" name="noof" id = "noof">
                <!-- Your form content goes here -->
                <div class="info">
                  <lable for="name">Name:-</lable>
                  <input type="text" id="name"  name="name">

                  <lable for="age">Age:-</lable>
                  <input type="text" id="age"  name="age">

               <lable for="phone">Contant_no:-</lable>
               <input type="text" id="phone"  name="cno">
 
               <lable for="address">Address:-</lable>
               <input type="text" id="address" name="address">

               <lable for = 'doctor'>Doctor_name</lable>
               <select name="doctor" id="doctor">
                <option value="" selected disabled >Select a doctor</option>
                <?php 
                    $read = "SELECT * FROM `doctor`";
                    $re = mysqli_query($link , $read);
                    $i = 1;
                    while($data = mysqli_fetch_assoc($re))
                    {
                    //    echo "<option value=".$i.">"echo.$data[doctor_name]"   <option>";        
                   ?>
                   
                   <option value="<?php echo $data['doctor_name']; ?>"><?php echo $data['doctor_name']; ?></option>


                   <?php
                
                    }

                ?>
                
               </select>

               <lable for="disease">Disease:-</lable>
               <input type="text" id="disease" name="disease">

               <lable for="medicines">Medicines:-</lable>
               <input type="text" id="medicines" name="medicines">

               <lable for="room">Room_no:-</lable>
               <input type="text" id="room" name="room_no">
                 </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" name = 'close' data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name = 'up' data-bs-dismiss="modal">update</button>
            </div>
                </form>
            </div>
           
        </div>
    </div>
</div>

</div>

<!-- Button trigger modal -->

<!-- Modal -->
<!-- //modal of delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../phps/old.php" method = 'post'>
      <div class="modal-body">
        <input type="hidden" name="del" class="deleter">
        <div>confirm to delete Paitent's details!</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary dels" name = 'delete'>confirm Delete</button>
      </div>
    </form>
    </div>
  </div>
</div>



<?php require "../parts/bootstap_js.php"; ?>

<script src="../parts/script.js"></script>
<?php require '../parts/footer.php'; ?>
</body>
</html>
