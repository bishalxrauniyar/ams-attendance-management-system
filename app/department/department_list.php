<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Department List</title>
</head>
<style>
  body {
    background-color: #f2f2f2;
  }

  h1 {
    text-align: center;
    color: #4CAF50;
  }

  table {
    border-collapse: collapse;
    width: 100%;
    background-color: white;
    border: 1px solid #ddd;
  }

  th, td {
    border: 1px solid #ddd;
    padding: 8px;
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
    margin:inherit;
 
  }

  .add-button,
  .edit-button,
  .delete-button {
    background-color: #4CAF50;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .add-button:hover,
  .edit-button:hover,
  .delete-button:hover {
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
  </style>
  
<body>
<div class="container">
  <h1>Department List</h1>

  <?php
  // Fetch data from the "department" table
  $query = "SELECT * FROM ams.department";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>Actions</th></tr>";

    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      
      // Create a link to the page that lists batches for the department
      echo "<td><a href='../batch/select_batch.php?dep_id=" . $row['dep_id'] . "'>" . $row['dep_name'] . "</a></td>";
      
      // Keep the edit and delete buttons 
      echo "<td>";
      echo "<button class='edit-button' onclick='editDepartment(" . $row['dep_id'] . ")'>Edit</button> | ";
      echo "<button class='delete-button' onclick='deleteDepartment(" . $row['dep_id'] . ")'>Delete</button>";
      echo "</td>";
      echo "</tr>";
    }

    echo "</table>";
  } else {
    echo "No departments found.";
  }
  ?>

  <br>
  <button class="add-button" onclick="addDepartment()">Add Department</button>
  <!-- <div class="iframe-container">
    <iframe id="iframe-content" src="" frameborder="0"></iframe>
  </div> -->


  <script>
    function editDepartment(dep_id) {
      window.location.href = 'edit_department.php?dep_id=' + dep_id;
    }

    function deleteDepartment(dep_id) {
      window.location.href = 'delete_department.php?dep_id=' + dep_id;
    }

    function addDepartment(dep_id) {
      window.location.href = 'add_department.php?dep_id=' + dep_id;
    }
  </script>
</div>
</body>
</html>