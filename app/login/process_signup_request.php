<?php
// Include your load.php here
$PAGE_ROLE="ADMIN";
include_once('../../system/load.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Getting  the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $roll_no = $_POST['roll_no'];
    $phone_no = $_POST['phone_no'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    

    if (empty($email)) {
        forward('signup.php', 'error', 'empty email');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        forward('signup.php', 'error', 'email not valid');
        die;
    }
    
    // Check if the email already exists in the database
    $stmt = $conn->prepare("SELECT email FROM user WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        forward('signup.php', ['error'=>'Email already exists']);
        die;
    }
    
    // Validate the phone number
    $phone_no = test_input($_POST['phone_no'], 'signup.php');
    if(!preg_match("/^[0-9]{10}$/", $phone_no)) {
        forward('signup.php', 'error', 'Not valid number');
        die;
    }

    // Check if the name already exists in the database
    $stmt = $conn->prepare("SELECT student_name FROM student WHERE student_name = ? LIMIT 1");
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        forward('signup.php', 'error', 'Username already exists');
        die;
    }
    
    // Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO student (name, email, roll_no, phone_no, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $name, $email, $roll_no, $phone_no, $role);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect to the signup page with success message
    forward('index.php', ['success' => 'Username added successfully']);
} else {
    // If the form is accessed directly without submission, redirect to the signup page
    header("Location: signup.php");
    exit();
}
?>
