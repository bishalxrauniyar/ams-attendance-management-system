<?php
$PAGE_ROLE='ADMIN';
// Create a connection
include('../../system/load.php');
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

$stmt = $conn->prepare("SELECT email FROM user WHERE email = ? limit 1");
$stmt->bind_param('s', $email);
$stmt->execute();
$result =$stmt->get_result();
if($row = $result->fetch_assoc()){
    forward('index.php','error','Email already exist');
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

$stmt = $conn->prepare("SELECT username FROM user WHERE username = ? limit 1");
$stmt->bind_param('s', $username);
$stmt->execute();
$result =$stmt->get_result();
if($row = $result->fetch_assoc()){
    forward('index.php','error','Username already exist');
    die;
}

/* INSERTING / UPDATE / DELETE */
$stmt = $conn->prepare("INSERT INTO user (username, email, password, phone_no, role) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param('sssss', $username, $email, $password, $phone_no, $role);
$stmt->execute();
forward('index.php',['success'=>'Username added successfully']);
