<?php
session_start();
$conn=require_once('../../system/database.php');
if(isset($_POST['username']) && isset($_POST['password']))
{
      // Perform a query to retrieve the user with the given username
      $username=$_POST['username'];
      $password=$_POST['password'];
    $stmt=$conn->prepare("SELECT * FROM user WHERE username=? and password=? limit 1");
    $stmt->bind_param('ss',$username,$password);
    $stmt->execute();
    $result =$stmt->get_result();
    //verify the email
    if($row = $result->fetch_assoc()){
    $_SESSION["user_id"] = $row["user_id"];

        switch($row["role"]){
            case 'ADMIN':
                header('location:../adash/');
                break;
            case 'TEACHER':
                header('location:../tdash/'); 
                break;
            case 'STUDENT':
                header('location:../sdash/');
                break;
                default:
            die;
        }
    }
    

    else{
        header("location: index.php?error=invalid user or password");
        // forward('index.php',['error'=>'invalid user or password','success'=>'user added sucessfully']);
    }
}

?>