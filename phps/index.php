<?php 
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{


    if(isset($_POST["submit"]))
    {
      
        $username=$_POST['username'];
        $password=$_POST['password'];
    
    
        $host="localhost";
        $dbusername="root";
        $dbpassword="";
        $dbname="hospital";
    
    
        $conn= new mysqli($host,$dbusername,$dbpassword,$dbname);
    
        if($conn->connection_error)
        {
            die("connection failed: " .$conn->connect_error);
    
        }
    
        
    
        $query="SELECT * FROM login WHERE `username`='$username' AND `password`='$password'";
    
        $result=$conn->query($query);
    
    
        if($result ->num_rows == 1)
        {
            //login done
            $_SESSION['username'] = $_POST['username']; 
            $_SESSION['pass'] = $_POST['password']; 
    
            header("Location: home.php");
            exit();
        }
        else
        {
    
              echo "<script type='text/javascript'>alert('user name or password is incorrect');</script>";
              echo "<script type='text/javascript'>window.location.href='index.php';</script>";
            exit();
    
        }
    
        $conn->close();
    }
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>login</title>

    <link rel="stylesheet" href="../styles/login.css">

</head>
<body>
  <h1>admin login</h1>
    <div class="login1">

    <form action="index.php" method="post" align="center">

    <label>Username: </label>
    <input type="text" name="username" required><br><br>
    <label>Password: </label>
    <input type="password" name="password">
   <br><br> <input type="submit" class="btn btn-primary" value="login" name = 'submit' required>
</form>
</div>
 

</body>
</html>