<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
?>

<?php

if (isset($_GET['batch_id'])) {
  $batchId = $_GET['batch_id'];

  // Fetch the batch details based on the ID from the "batch" table
  $query = "SELECT * FROM ams.batch WHERE batch_id = $batchId";
  $result = $conn->query($query);
 
  if ($result->num_rows > 0) {
    $batch = $result->fetch_assoc();
    $batchName = $batch['batch_name'];
  } else {
    echo "<script>window.location.href = 'select_batch.php';</script>";
  }
} else {
  echo "<script>window.location.href = 'select_batch.php';</script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Update the batch details in the "batch" table
  $newBatchName = $_POST['batchName'];

  $updateQuery = "UPDATE ams.batch SET batch_name = ? WHERE batch_id = ?";
  $stmt = $conn->prepare($updateQuery);
  $stmt->bind_param("si", $newBatchName, $batchId);

  if ($stmt->execute()) {
    // Redirect back to the batch list page
    header('location: select_batch.php');
    die;
  } else {
    echo "Error updating batch: " . $stmt->error;
  }
}
?>







<!DOCTYPE html>
<html>
<head>
  <title>Edit Batch</title>
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
    <h2>Edit Batch (ID: <?php echo $batchId; ?>)</h2>
    <form method="POST">
      <label for="batchName">Batch Name:</label>
      <input type="text" id="batchName" name="batchName" value="<?php echo $batchName; ?>" required>
      <br><br>
      <input type="submit" value="Save">
    </form>
  </div>
</body>
</html>