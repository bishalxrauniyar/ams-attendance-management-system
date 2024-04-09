<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
// Fetch the list of departments to populate the dropdown
$departmentQuery = "SELECT * FROM ams.department";
$departmentResult = $conn->query($departmentQuery);


  if (isset($_POST['semester_name']) && isset($_GET['batch_id'])) {
    $semesterName = $_POST['semester_name'];
    $batchId=$_GET['batch_id'];

      $query = "INSERT INTO ams.semester (semester_name,batch_id) VALUES (?, ?)";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("si", $semesterName,$batchId);

      // Execute the prepared statement
      if ($stmt->execute()) {
        // Redirect to the semester list page
        forward('add_semester.php',['success'=>'Semester successfully added'] );
        exit();
      } else {
        forward('add_semester.php',['error'=>'ERROR adding Semester'] );
      }
    } 

?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Semester</title>
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
      color: #4CAF50;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: white;
      border-radius: 4px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Add Semester</h2>
    <form method="POST">
      <label for="semesterName">Semester Name:</label>
      <input type="text" id="semesterName" name="semester_name" required>
      <br><br>
      <input type="submit" value="Add<?php echo isset($_GET['batch_id']);?>">
    </form>
  </div>
  <error>
            <?php 
                if(isset($_GET['error'])){
                        echo htmlspecialchars($_GET['error']);
                }
            ?>
            </error>
</body>
</html>
