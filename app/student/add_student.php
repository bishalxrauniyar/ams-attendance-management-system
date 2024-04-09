<?php
$PAGE_ROLE ='ADMIN';
require_once('../../system/html_load.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
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
    <h2>Add Student</h2>
    <?php if (isset($error_message)) { ?>
      <p><?php echo $error_message; ?></p>
    <?php } ?>
    <form action="add_student_request.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="student_name" id="student_name" required><br><br>

        <label for="rollno">Roll Number:</label>
        <input type="text" name="roll_no" id="roll_no" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="phone">Phone Number:</label>
        <input type="tel" name="phone_no" id="phone_no" required><br><br>

        <label for="address">Address:</label>
        <textarea name="address" id="address" required></textarea><br><br>
        <label for="batch_name">Batch Name:</label>
<select name="batch_name" id="batch_name">
    <option value=""></option>
    <?php
    $batchQuery = "SELECT * FROM ams.batch";
    $result = mysqli_query($conn, $batchQuery);
if (!$result) {
    die("Error retrieving batches: " . mysqli_error($conn));
}
    $batchs = []; 
    while ($row = mysqli_fetch_assoc($result)) {
        $batchs[] = $row['batch_name'];
    }
    foreach ($batchs as $batch) {
        echo '<option value="' . $batch . '">' . $batch . '</option>';
    }
    ?>
</select>
<br><br>

        <button class="add-button" onclick="addBatch(<?php echo isset($_GET['batch_id']);?>)">Add Student</button>
    </form>
    <script>
        function addBatch(batch_id) {
    // Redirect to the add_subject.php page
    window.location.href = 'add_student.php?batch_id=' + batch_id;
}


      </script>
        <error>
            <?php 
                if(isset($_GET['error'])){
                        echo htmlspecialchars($_GET['error']);
                }
            ?>
            </error>
</body>
</html>
