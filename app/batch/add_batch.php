<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');


// Fetch the list of departments to populate the dropdown
$departmentQuery = "SELECT * FROM ams.department";
$departmentResult = $conn->query($departmentQuery);
 

if (isset($_POST['batch_name']) && isset($_POST['dep_id'])) {
  $batchName = $_POST['batch_name'];
  $depId = $_POST['dep_id'];
    

    // Check if the provided dep_id exists in the department table
   
      // Prepare the query to insert a new batch into the "batch" table
      $query = "INSERT INTO ams.batch (batch_name, dep_id) VALUES (?, ?)";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("si", $batchName, $depId);

      // Execute the prepared statement
      if ($stmt->execute()) {
        // Redirect to the batch list page
        // header("Location: add_batch.php?");
        forward('add_batch.php',['success'=>'Batch added successfully']);
        exit();
      } else {
        echo "Error adding batch: " . $stmt->error;
      }
    } 
 
?>
<?php
$dep_Id = isset($_GET['dep_id']) ? $_GET['dep_id'] : 0;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Batch</title>
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
    <h2>Add Batch</h2>
    <form method="POST" action="">
    <input type="hidden" name="dep_id" value="<?php echo $dep_Id; ?>">
      <label for="batchName">Batch Name:</label>
      <input type="text" id="batchName" name="batch_name" required>
      
      <br><br>
      <input type="submit" value="Add">
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