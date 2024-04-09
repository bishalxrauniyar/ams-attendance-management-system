<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Add the department to the "department" table
  $departmentName = $_POST['departmentName'];

  $insertQuery = "INSERT INTO ams.department (dep_name) VALUES (?)";
  $stmt = $conn->prepare($insertQuery);
  $stmt->bind_param("s", $departmentName);
  if ($stmt->execute()) {
    // Redirect to the batch list page
    header("Location: department_list.php");
    die;
  } else {
    echo "Error adding batch: " . $stmt->error;
  }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Add Department</title>
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

    button {
      background-color: #4CAF50;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin:4px 0px;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Add Department</h2>
    <form method="POST">
      <label for="departmentName">Department Name:</label>
      <input type="text" id="departmentName" name="departmentName" required>
      <button type="submit">Add</button>
    </form>
  </div>
</body>
</html>