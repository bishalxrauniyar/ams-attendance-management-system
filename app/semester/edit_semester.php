<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
$semesterId=null;
$semesterName='';

      if (isset($_GET['semester_id'])) {
  $semesterId = $_GET['semester_id'];
  $query = "SELECT * FROM ams.semester WHERE semester_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $semesterId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      $semester = $result->fetch_assoc();
      $semesterName = $semester['semester_name'];
  } 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Update the batch details in the "batch" table
  $newsemesterName = $_POST['semesterName'];

  $updateQuery = "UPDATE ams.semester SET semester_name = ? WHERE semester_id = ?";
  $stmt = $conn->prepare($updateQuery);
  $stmt->bind_param("si", $newsemesterName, $semesterId);

  if ($stmt->execute()) {
      // Redirect back to the batch list page
      forward('edit_semester.php',["success"=>"Successfully Updated"]);
      exit();
  } else {
    forward('edit_semester.php',["error"=>"Error Editing Semester"]);
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Semester</title>
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

    input[type="text"] {
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
    <h2>Edit Semester (ID: <?php echo $semesterId; ?>)</h2>
    <form method="POST">
      <label for="semesterName">Semester Name:</label>
      <input type="text" id="semesterName" name="semesterName" value="<?php echo $semesterName; ?>" required>
      <br><br>
      <input type="submit" value="Save">
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
