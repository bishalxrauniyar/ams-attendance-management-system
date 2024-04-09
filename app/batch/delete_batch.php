<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
$batchId = null;
$batchName = '';
if (isset($_GET['batch_id'])) {
  $batchId = $_GET['batch_id'];

  // Prepare the SQL statement to fetch the batch details
  $query = "SELECT * FROM ams.batch WHERE batch_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $batchId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $batch = $result->fetch_assoc();
    $batchName = $batch['batch_name'];
  }
  else{
    die("Invalid Batch ID");
  }
}
  

 if($_SERVER['REQUEST_METHOD'] ==='POST'){
  // Prepare the SQL statement to delete the batch
  $deleteQuery = "DELETE FROM ams.batch WHERE batch_id = ?";
  $stmt = $conn->prepare($deleteQuery);
  $stmt->bind_param("i", $batchId);

  if ($stmt->execute()) {
    // Redirect back to the batch list page
forward('delete_batch.php',['success'=>'Batch Deleted Successfully']);
    exit;
  } else {
    forward('delete_batch.php',['error'=>'Error Deleting Batch']);
    exit;
  }
} 


?>

<!DOCTYPE html>
<html>
<head>
  <title>Delete Batch</title>
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
    <h2>Delete Batch (ID: <?php echo $batchId; ?>)</h2>
    <p>Are you sure you want to delete the batch "<?php echo $batchName; ?>"?</p>
    <form method="POST">
      <input type="submit" value="Confirm Delete">
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