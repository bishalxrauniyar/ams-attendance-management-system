<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Batch List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
      color: #4CAF50;
      margin-top: 20px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      background-color: white;
      border: 1px solid #ddd;
      padding: 10px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    .container {
      max-width: 900px;
      padding: 15px;
      margin: 0 auto;
    }

    .add-button,
    .edit-button,
    .delete-button,
    .view-link {
      background-color: #4CAF50;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
      display: inline-block;
      margin: 5px;
    }

    .add-button:hover,
    .edit-button:hover,
    .delete-button:hover,
    .view-link:hover {
      background-color: #45a049;
    }

    .iframe-container {
      margin-top: 20px;
      margin-left: 50px;
    }

    .iframe-container iframe {
      width: 100%;
      height: 400px;
      border: none;
    }

    .add-button {

      margin: 20px auto;
    }

  </style>
</head>
<body>
  <h1>Batch List</h1>

  <div class="container">
  <?php
    // Check if the department ID is provided in the URL
    if (isset($_GET['dep_id'])) {
      $dep_id = $_GET['dep_id'];

      // Fetch data from the "batch" table for the selected department
      $query = "SELECT * FROM ams.batch WHERE dep_id = $dep_id";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Batch Name</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
          // Display the batch name and create edit and delete buttons for each batch
          echo "<tr>";
          echo "<td>" . $row['batch_name'] . "</td>";
          echo "<td>";
          echo "<button class='edit-button' onclick='editBatch(" . $row['batch_id'] . ")'>Edit </button> |";
          echo "<button class='delete-button' onclick='deleteBatch(" . $row['batch_id'] . ")'> Delete </button>";
          echo "</td>";
          echo "</tr>";

          // Create a link to the page that lists semesters for the selected batch
          echo "<tr>";
          echo "<td colspan='2'>";
          echo "<a href='../semester/select_semester.php?batch_id=" . $row['batch_id'] . " &dep_id=" . $row['dep_id'] . "' class='view-link'>View Semesters</a>";
          echo "&nbsp;";
          echo "<a href='../batchstudent/batch_student.php?batch_id=" . $row['batch_id'] . "' class='view-link'>View Students</a>";
          echo "</td>";
          echo "</tr>";
        }

        echo "</table>";
      
      }
      else{
        echo "No Batch Found";
      }

  
    }
    ?>
  </div>

  <a href="add_batch.php?dep_id=<?php echo isset($dep_id) ? $dep_id : 0; ?>" class="add-button">Add Batch</a>

  <script>
    function editBatch(batch_id) {
      // Redirect to the edit_batch.php page with the batch ID as a URL parameter
      window.location.href = 'edit_batch.php?batch_id=' + batch_id;
    }

    function deleteBatch(batch_id) {
      window.location.href = 'delete_batch.php?batch_id=' + batch_id;
    }

    function addBatch(dep_id) {
      // Redirect to the add_batch.php page
      window.location.href = 'add_batch.php?dep_id=' + dep_id;
    }
  </script>
</body>
</html>
