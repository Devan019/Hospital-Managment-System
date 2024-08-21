<?php 

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    if(isset($_POST['submit']))
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
            header("Location: home.php");
            exit();
        }
        else{
                //login falied
               
             //  header("location: index(main).php");
    
              //echo "<script type='text/javascript>alert('login failed');</script>";
              //echo "<script type='text/javascript>window.location.href='index(main).php'<./script>"
    
    
              echo "<script type='text/javascript'>alert('user name or password is incorrect');</script>";
              echo "<script type='text/javascript'>window.location.href='index.php';</script>";
            exit();
    
        }
    
        $conn->close();
    }
    
}

?>