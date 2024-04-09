<?php
$PAGE_ROLE='ADMIN';
// Create a connection
include('../../system/load.php');


$user_dtl=[];
if(isset($_GET['id'])){
    $id=test_input('id','../adash/','GET');
    // Prepare the query to search for a user
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_id = ?");
    if (!$stmt) {
        // Handle the error here
        echo "Error: " . $conn->error;
        exit;
    }
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows were returned

    if($user_dtl = $result->fetch_assoc()) {

    } else {
        die("USER NOT FOUND");
    }
}else{
    die('GET NOT SET');
}


if(empty($_POST)){
    header('location: index.php');
    die;
}


/*VALIDATION AND SANITIZATING*/

$username=test_input('username','index.php');
$email=test_input('email','index.php');
 /* FILTER EMAIL */

 if (empty($email)) {

    forward('index.php','error','empty email');
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    forward('index.php','error','email not valid');
    die;
}

$password=test_input('password','index.php');

if (empty($password)) {
    forward('index.php','error','password empty');
} elseif (strlen($password) < 8) {
    forward('index.php','error','Character must be greater than 8');
    die;
}

$phone_no=test_input('phone_no','index.php');
/* number 10 */

if (empty($phone_no)) {
    forward('index.php','error','empty number');
} elseif (!preg_match("/^[0-9]{10}$/", $phone_no)) {
    forward('index.php','error','Not vaild number');
    die;
}

$role=test_input('role','index.php');
/* number TEACHER KI ADMIN*/
if (empty($role)) {
    forward('index.php','error','role is empty');
} elseif ($role !== "TEACHER" && $role !== "ADMIN") {
    forward('index.php','error','Not vaild role ');
    die;
}
/*LOGIC */

// Check if the name already exists in the database
if($user_dtl['username'!=$username]){
    $stmt = $conn->prepare("SELECT username FROM user WHERE username = ? limit 1");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result =$stmt->get_result();
    if($row = $result->fetch_assoc()){
        forward('index.php','error','Username already exist');
        die;
    }
}


if($user_dtl['email'!=$email]){
    $stmt = $conn->prepare("SELECT email FROM user WHERE email = ? limit 1");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result =$stmt->get_result();
    if($row = $result->fetch_assoc()){
        forward('index.php','error','Email already exist');
        die;
    }
}

/* INSERTING / UPDATE / DELETE */
$stmt = $conn->prepare('update user set username = ? ,email =? , password=? , phone_no=? , role = ? where user_id=?');
$stmt->bind_param('sssisi', $username, $email, $password, $phone_no, $role,$user_dtl['user_id']);
$stmt->execute();
forward('user_edit_index.php',['success'=>'Username edit successfully','id'=>$user_dtl['user_id']]);
