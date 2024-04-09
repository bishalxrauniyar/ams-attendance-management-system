<?php
$PAGE_ROLE = 'TEACHER';
require_once('../../system/load.php');
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
    padding: auto;
    border-collapse: collapse;
    width: 80%;
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
  <center>
<div class="container">
  <h1>SELECT DEPARTMENT</h1>

  <?php
  // Fetch data from the "department" table
  $query = "SELECT * FROM ams.department";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Name</th></tr>";

    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      
      // Create a link to the page that lists batches for the department
      echo "<td><a href='batch_list.php?dep_id=" . $row['dep_id'] . "'>" . $row['dep_name'] . "</a></td>";
      echo "</tr>";
    }

    echo "</table>";
  } else {
    echo "No departments found.";
  }
  ?>
  </script>
</div>
</center>
</body>
</html>
