<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');

$error_message = ''; // Initialize the error message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $batchName = $_POST['batch_name']; // Assuming batch_name is coming from the form

    // Prepare and execute the batch ID query
    $stmt = $conn->prepare("SELECT batch_id FROM ams.batch WHERE batch_name = ?");
    $stmt->bind_param("s", $batchName);
    $stmt->execute();
    $batchresult = $stmt->get_result();

    if ($batchresult->num_rows > 0) {
        $row = $batchresult->fetch_assoc();
        $batchId = $row['batch_id'];
    } else {
        $error_message = 'Invalid batch ID';
    }

    if (empty($error_message)) {
        // Retrieve the form data
        $student_name = $_POST['student_name'];
        $roll_no = $_POST['roll_no'];
        $email = $_POST['email'];
        $phone_no = $_POST['phone_no'];
        $address = $_POST['address'];

        // Insert the student record into the database
        $stmt = $conn->prepare("INSERT INTO student (student_name, roll_no, email, phone_no, address, batch_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssi', $student_name, $roll_no, $email, $phone_no, $address, $batchId);

        if ($stmt->execute()) {
            // Redirect back to the student list with a success message
            header('Location: add_student.php?message=success');
            forward('add_student.php',['success'=>'Student Added Successfully']);
            exit;
        } else {
            // Handle the database insertion error
            forward('add_student.php',['error'=>'Error Adding Students']);
        }
    }
}

// Close the database connection
$conn->close();
?>