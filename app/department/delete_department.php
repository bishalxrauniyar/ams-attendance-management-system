<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
?>
<?php
if (isset($_GET['dep_id'])) {
  $departmentId = $_GET['dep_id'];

  // Fetch the department details based on the ID from the "department" table
  $query = "SELECT * FROM ams.department WHERE dep_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $departmentId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $department = $result->fetch_assoc();
    $departmentName = $department['dep_name'];
  } else {
    echo "<script>window.location.href = 'department_list.php';</script>";
  }
} else {
  echo "<script>window.location.href = 'department_list.php';</script>";
}

  // Delete the department from the "department" table
  $deleteQuery = "DELETE FROM ams.department WHERE dep_id = ?";
  
  $stmt = $conn->prepare($deleteQuery);
  $stmt->bind_param("i", $departmentId);


  if ($stmt->execute()) {
    // Redirect back to the batch list page
    echo "<script>window.location.href = 'department_list.php';</script>";
    exit;
  } else {
    echo "Error deleting department.";
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Delete Department</title>
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
  <h2>Delete Department (ID: <?php echo $departmentId; ?>)</h2>
  <p>Are you sure you want to delete the department "<?php echo $departmentName; ?>"?</p>
  <form method="POST">
    <input type="submit" value="Confirm Delete">
  </form>
  </div>
</body>
</html>