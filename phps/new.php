
<?php
$warn = false;
$warn1 = false;
session_start();
if(!isset($_SESSION['username']))
{
    header('location:index.php');
}
    require '../parts/db.php';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(isset($_POST['add']))
        {
            if(isset($_POST['doctor']))
            {
            $name = $_POST['nname'];
            $age = $_POST['nage'];
            $cno = $_POST['ncno'];
            $address = $_POST['naddress'];
            $doctor = $_POST['doctor'];
            $disease = $_POST['ndisease'];
            $medicines = $_POST['nmedicines'];
            $room_no = $_POST['nroom_no'];
            $cno = filter_var($cno, FILTER_VALIDATE_INT) && strlen($cno);
            $room_no = filter_var($room_no, FILTER_VALIDATE_INT) && strlen($room_no);
            $c = 0;
            // for ($i = 0; $i < strlen($cno); $i++) {
            //     if ($cno[$i] >= 0 && $cno[$i] <= 9) {
            //         $c++;
            //     }
            // }
            // $c1  = 0;
            // for ($i = 0; $i < strlen($room_no); $i++) {
            //     if ($room_no[$i] >= 0 && $room_no[$i] <= 9) {
            //         $c1++;
            //     }
            // }
    
            if (!$cno) {
                $warn = true;
            }
            if(!$room_no)
            {
                $warn1 = true;
            }
            else
            {
                $sql = "INSERT INTO `patients`( `name`, `phone`, `age`, `address`, `doctor_name`, `disease`, `medicines`, `room_no`) VALUES ('$name','$cno','$age','$address','$doctor','$disease','$medicines','$room_no')";

            echo $sql;
            // echo $i. "<br>";
            $r = mysqli_query($link , $sql);
            echo $r;
            if($r)
            {
                header('location:old.php');
            }
            else
            {
                echo "sorry!";
            }
            }
            }

        }
    }
    if($warn)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='danger'>
    <strong>WARN!</strong> Patient's phone no is not valid!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
    }
    if($warn1)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='danger'>
    <strong>WARN!</strong> Patient's room no is not valid!
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


</head>
<body>
<?php require "../parts/nav.php"; ?>

<h2>new patient information</h2>
<div class="new">

    <form action="new.php" method="POST">

   <label for="name">Name:-</label>
      <input type="text" id="name"  name="nname" required><br>

              <label for="age">Age:-</label>
              <input type="text" id="age"  name="nage" required><br>

               <label for="phone">Contant_no:-</label>
               <input type="text" id="phone"  name="ncno" required><br>
 
               <label for="address">Address:-</label>
               <input type="text" id="address" name="naddress" required><br>
               
               <lable for = 'doctor'>Doctor_name</lable>
               <select name="doctor" id="doctor">
                <optgroup lable = "select doctor">
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
                <optgroup>
               </select><br>
                    
               <label for="disease">Disease:-</label> 
               <input type="text" id="disease" name="ndisease" required><br>

               <label for="medicines">Medicines:-</label>
               <input type="text" id="medicines" name="nmedicines" required><br>

               <label for="room">Room_no:-</label>
               <input type="text" id="room" name="nroom_no" required><br>

              <button type="submit" class="btn btn-primary" name = 'add' data-bs-dismiss="modal">add</button>


</form>



</div>
<?php require "../parts/foot.php"; ?>



<?php require "../parts/bootstap_js.php"; ?>
<!--  -->
</body>
</html>