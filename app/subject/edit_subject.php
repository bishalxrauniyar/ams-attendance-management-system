<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
?>

<?php
if (isset($_GET['subject_id'])) {
  $subjectId = $_GET['subject_id'];

  // Fetch the department details based on the ID from the "subject" table
  $query = "SELECT * FROM ams.subject WHERE subject_id = $subjectId";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $subject= $result->fetch_assoc();
    $subjectName = $subject['subject_name'];
  } else {
      header('location:subject_list.php');
       die; 
  }
} else {
  header('location:subject_list.php');
  die;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Update the department details in the "department" table
  $newsubjectName = $_POST['subjectName'];

  $updateQuery = "UPDATE ams.subject SET subject_name = ? where subject_id = ?";
  $stmt = $conn->prepare($updateQuery);
  $stmt->bind_param("si", $newsubjectName,$subjectId);


  if ($stmt->execute()) {
    // Redirect back to the batch list page
    header('location: subject_list.php');
    die;
  } else {
    echo "Error updating Subject: " . $stmt->error;
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Subject</title>
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
  <h2>Edit Subject (ID: <?php echo $subjectId; ?>)</h2>
  <form method="POST">
    <label for="subjectName">Subject Name:</label>
    <input type="text" id="subjectName" name="subjectName" value="<?php echo $subjectName; ?>" required>
    <br><br>
    <input type="submit" value="Save">
  </form>
</body>
</html>
