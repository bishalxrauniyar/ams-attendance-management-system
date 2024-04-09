<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
$studentName='';
$student_id=null;
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $deleteQuery = "DELETE FROM ams.student WHERE student_id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $student_id);

        if ($stmt->execute()) {
            // Redirect back to the student list page with a success message
            // header('Location: delete_student.php?m');
            forward('delete_student.php',['success'=>'Student Deleted Sucessfully']);
            exit;
        } else {
            forward('delete_student.php',['error'=>'Error Deleting Student']);
            exit;
        }
    }

    $query = "SELECT student_name FROM ams.student WHERE student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        $studentName = $student['student_name'];
    } else {
        // Handle case where student is not found
        echo '<div class="message error">Student not found.</div>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
    <success>
        <?php
        if(isset($_GET['success'])){
            echo htmlspecialchars($_GET['success']);
        }
        ?>
</success>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            color: #f44336;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        p {
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="submit"] {
            background-color: #f44336;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Delete Student (ID: <?php echo $student_id; ?>)</h2>
    <p>Are you sure you want to delete the student "<?php echo $studentName; ?>"?</p>
    <form method="POST" action="">
        <input type="submit" value="Confirm Delete">
    </form>
</div>
<error>
        <?php
        if(isset($_GET['error'])){
            echo htmlspecialchars($_GET['error']);
        }
        ?>
</success>
</body>
</html>
