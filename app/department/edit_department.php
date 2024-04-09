<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
?>

<?php
if (isset($_GET['dep_id'])) {
  $departmentId = $_GET['dep_id'];

  // Fetch the department details based on the ID from the "department" table
  $query = "SELECT * FROM ams.department WHERE dep_id = $departmentId";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $department = $result->fetch_assoc();
    $departmentName = $department['dep_name'];
  } else {
    echo "<script>window.location.href = 'department_list.php';</script>";
 
  }
} else {
  echo "<script>window.location.href = 'department_list.php';</script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Update the department details in the "department" table
  $newDepartmentName = $_POST['departmentName'];

  $updateQuery = "UPDATE ams.department SET dep_name = ? where dep_id = ?";
  $stmt = $conn->prepare($updateQuery);
  $stmt->bind_param("si", $newDepartmentName,$departmentId);
  if ($stmt->execute()) {
    // Redirect back to the batch list page
    header('location: department_list.php');
    die;
  } else {
    echo "Error updating Department: " . $stmt->error;
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Department</title>
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
  <h2>Edit Department (ID: <?php echo $departmentId; ?>)</h2>
  <form method="POST">
    <label for="departmentName">Department Name:</label>
    <input type="text" id="departmentName" name="departmentName" value="<?php echo $departmentName; ?>" required>
    <br><br>
    <input type="submit" value="Save">
  </form>
</body>
</html>
