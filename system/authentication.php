<?php
if(empty($_SESSION['user_id'])){
header('location: ../login/index.php');
}

$stmt=$conn->prepare("SELECT * FROM user WHERE user_id=? limit 1");
$stmt->bind_param('s',$_SESSION['user_id']);
$stmt->execute();
 $result =$stmt->get_result();   
if($row = $result->fetch_assoc()){
    if(isset($PAGE_ROLE)){
        if($PAGE_ROLE!=$row['role']){
            die('USER NOT ALLOW IN THIS PAGE ');
        }
    }else{
        die('PAGE ROLE VARIABLE NOT FOUND');
    }
}else{
    header('location: ../login/index.php');
}

?>
