<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');

$student='';
// Check if the student ID is provided
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Fetch the student details from the database using prepared statement
    $sql = "SELECT * FROM student WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the updated values from the form
            $student_name = $_POST['student_name'];
            $roll_no = $_POST['roll_no'];
            $email = $_POST['email'];
            $phone_no = $_POST['phone_no'];
            $address = $_POST['address'];

            // Update the student record in the database using prepared statement
            $update_sql = "UPDATE student SET student_name = ?, roll_no = ?, email = ?, phone_no = ?, address = ? WHERE student_id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param('sssssi', $student_name, $roll_no, $email, $phone_no, $address, $student_id);

            if ($stmt->execute()) {
                // Redirect back to the student list with a success message
              
                forward('edit_student.php',['success'=>'Successfully Updated Student']);
                exit;
            } else {
                // Handle the database update error
                forward('edit_student.php',['error'=>'Error Updating Student']);
            }
        }
    } else {
        // Handle student record not found error
        $error_message = 'Student record not found.';
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Handle case where student ID is not provided
    $error_message = 'Student ID not provided.';
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <success>
    <?php 
                if(isset($_GET['success'])){
                        echo htmlspecialchars($_GET['success']);
                }
            ?>
            </success>
    <style>
           body {
    font-family: 'Helvetica Neue', Arial, sans-serif;
    background-color: #f8f8f8;
    margin: 0;
    padding: 0;
    color: #333;
}

h2 {
    text-align: center;
    margin-top: 40px;
    color: #e74c3c;
    font-size: 28px;
    letter-spacing: 1px;
}

form {
    max-width: 500px;
    margin: 0 auto;
    padding: 30px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

label {
    display: block;
    margin-bottom: 12px;
    font-weight: bold;
    color: #3498db;
}

input[type="text"],
input[type="email"],
input[type="tel"],
textarea,
select {
    width: 100%;
    padding: 14px;
    border: none;
    border-bottom: 2px solid #3498db;
    background-color: rgba(255, 255, 255, 0.7);
    color: #333;
    margin-bottom: 20px;
    transition: border-color 0.3s ease, background-color 0.3s ease;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
textarea:focus,
select:focus {
    border-color: #e74c3c;
    background-color: rgba(255, 255, 255, 0.9);
}

select {
    height: 48px;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.add-button {
    background-color: #27ae60;
    color: #fff;
    padding: 14px 28px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    letter-spacing: 1px;
    transition: background-color 0.3s ease;
}

.add-button:hover {
    background-color: #2ecc71;
}

.error {
    color: #e74c3c;
    font-size: 14px;
    margin-top: 10px;
    display: block;
}

.success {
    color: #2ecc71;
    font-size: 14px;
    display: block;
}


    </style>
</head>
<body>
    <h2>Edit Student</h2>
      <form action="" method="POST">
    <label for="student_name">Student Name:</label>
    <input type="text" name="student_name" id="student_name" value="<?php echo $student['student_name']; ?>" required><br><br>

    <label for="roll_no">Roll Number:</label>
    <input type="text" name="roll_no" id="roll_no" value="<?php echo $student['roll_no']; ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $student['email']; ?>" required><br><br>

    <label for="phone_no">Phone Number:</label>
    <input type="tel" name="phone_no" id="phone_no" value="<?php echo $student['phone_no']; ?>" required><br><br>

    <label for="address">Address:</label>
    <textarea name="address" id="address" required><?php echo $student['address']; ?></textarea><br><br>

    <input type="submit" value="Update Student">
</form>
<error>
            <?php 
                if(isset($_GET['error'])){
                        echo htmlspecialchars($_GET['error']);
                }
            ?>
            </error>
</body>
</html>
