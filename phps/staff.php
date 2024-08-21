<?php
session_start();
if(!isset($_SESSION['username']))
{
  header('location:index.php');
}
    require '../parts/db.php';
?>
<?php
$warn = false; 
$sdelete = false;
$supdate = false;
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  
    if(isset($_POST['up']))
    {
        $id = $_POST['noof'];
        $member = $_POST['member'];
        $no = $_POST['no'];
        $pos = $_POST['position'];

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
            $warn = true;
        
        }
        else
        {
           
           $update = "UPDATE `staff` SET `member_name`='$member',`position`='$pos',`contact_no` = '$no' WHERE `sr.no` = '$id'";
            $result = mysqli_query($link , $update);
            if($result)
            {
              $supdate = true;
            }
            // else
            // {
            //   echo "op";
            // }
        }

    }
    
    // else if(isset($_POST['deleter']))
    // {
    //   // if(isset($_POST['deleter']))
    //   {
       
    //     $id = $_POST['deleter'];
    //     echo "hi!<br>" .$_POST['deleter'];
    //     $delete = "DELETE FROM `staff` WHERE `sr.no` = '$id'";
    //     echo $delete;

    //     $result = mysqli_query($link, $delete);
    //     // if($result)
    //     // {
    //     //     echo "op";
    //     //     $sdelete = true;
    //     // }
    //     // else
    //     // {
    //     //     echo "pioip";
    //     // }
    //     }
    //   }
      // else
      // {
      //   echo "sorry!";
      // }
}


$read = "SELECT * FROM `staff`";
$result = mysqli_query($link , $read);

$row = mysqli_num_rows($result);
if($_SERVER['REQUEST_METHOD'] == "POST")
{
  $i = 1;
  while($data = mysqli_fetch_assoc($result))
  {
    $id = $data['sr.no'];
    if(isset($_POST["delete$i"]))
    {
      $delete = "DELETE FROM `staff` WHERE `sr.no` = '$id'";
      $r = mysqli_query($link ,$delete);
      if($r)
      {
        $sdelete = true;
      }
    }
    $i++;
  }

}
?>
<?php
if($sdelete)
{
  echo "<div class='alert alert-success alert-dismissible fade show' role='success'>
  <strong>SuccessFully !</strong>  staff's details will be deleted!
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
if($supdate)
{
  echo "<div class='alert alert-success alert-dismissible fade show' role='success'>
    <strong>Congratulation!</strong> staff's details will be updated!
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
if($warn)
{
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
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.4/css/dataTables.dataTables.min.css">
    <?php require "../parts/bootstap_css.php"; ?>
    <style>
        [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: pointer;
    margin: 10px;
}
a button{
    position: relative;
    left : 85vw;
  }
    </style>
</head>
<body>
<?php require '../parts/nav.php'; ?>

    <h2>list of Staff</h2>
<div class='tableof'>
<table class="table" id="myTable">
  <thead>
    <tr>
    
      <th>Sr.no</th>
      <th>doctor_name</th>
      <th>member_name</th>
      <th>Contact_no</th>
      <th>position</th>
      <th></th>
      
    </tr>
  </thead>
  <tbody>
    <?php
        $read = "SELECT * FROM `staff`";
        $result = mysqli_query($link , $read);
        
        if(isset($_SESSION['name']))
        {
        $name_doc = $_SESSION['name'];
        $i = 1;
        while($data = mysqli_fetch_assoc($result))
        {
          
            if($data['doctor_name'] == $name_doc)
            {
            
            echo "<tr>";
            
            echo "<td> " . $i . " </td>";
            echo "<td>" . $data['doctor_name'] . " </td>";
            echo "<td>" . $data['member_name'] . " </td>";
            echo "<td>" . $data['contact_no'] . " </td>";
            echo "<td>" . $data['position'] . " </td>";
            
            echo "<td><button type='button'  id=  ".$data['sr.no']." name = 'up' class='btn btn-primary ups' data-bs-toggle='modal' data-bs-target='#updateModal'>Update</button>";
            echo "<form action = '#' method = 'post'>";
            echo "<button type='submit'  id=  ".$data['member_name']." name = 'delete$i' class='btn btn-warning dels' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button>  </td>";
            echo "</form>";
            

            
            echo "</tr>";
            $i = $i + 1;
            }
            if($i == 1)
            {
               echo "<tr>";
               echo "<td colspan = '6'> No Record Found... </td>";
               echo "</tr>";
            }
        }
    }
    ?>
  </tbody>
</table>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <form action="staff.php" method='post'>
                <input type="hidden" name="noof" id = "noof">
                <!-- Your form content goes here -->
                <div class="info">

                  <lable for="member">Member_name</lable>
               <input type="text" id="member" name="member">

               <lable for="no">Contact_no</lable>
               <input type="text" id="no" name="no">

               <lable for="position">Position:-</lable>
               <input type="text" id="position"  name="position">               

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


<!--modal for deletes-->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="staff.php" method = 'post'>
       <div class="modal-body">
        <input type="hidden" name="id" class="id">
        <div>confirm to delete doctor's details!</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
        <button type="submit" class="btn btn-primary dels" name = 'delete'>confirm Delete</button>
      </div>
    </form>
    </div>
  </div>
</div>
<a href="newstaff.php"><button type="button" class="btn btn-primary">New staff member</button></a>
    <?php require "../parts/bootstap_js.php"; ?>

<script >
let allups = document.querySelectorAll('.ups');

Array.from(allups).forEach((e) => {
  e.addEventListener("click",(e) => {
    let tr = e.target.parentNode.parentNode;
    document.querySelector('#noof').value = e.target.id;
    document.querySelector('#member').value = tr.getElementsByTagName("td")[2].innerText;
    document.querySelector('#no').value = tr.getElementsByTagName("td")[3].innerText;
    document.querySelector('#position').value = tr.getElementsByTagName("td")[4].innerText;
  }
  )
}
)
// let alldes = document.querySelectorAll('.dels');

// Array.from(alldes).forEach((e) => {
//   e.addEventListener("click",(e) => {
//     document.querySelector(".id").value = e.target.id;
//     console.log(document.querySelector(".id").value);
//   }
//   )
// }
// )

</script>


<?php require '../parts/footer.php'; ?>

</body>
</html>