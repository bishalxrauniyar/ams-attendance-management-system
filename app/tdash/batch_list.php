<?php
$PAGE_ROLE = 'TEACHER';
include('../../system/load.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Batch List</title>
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
      padding:10px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 13px;
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
    margin: 0vh 10vw;
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
    .view-link {
    margin-right: 10px;
    color: blue;
    text-decoration: none;
    background-color: #4CAF50;
    color: white;
    padding: 8px 8px;
    border: 1px solid #4CAF50; /* Decreased border size */
    border-radius: 25px 25px 25px 25px ;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  .view-link:hover{
    background-color: #45a049;
  }
  .add-button{
   margin:6vh 12vw;
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
        echo "<tr><th>Batch Name</th></tr>";
        while ($row = $result->fetch_assoc()) {
          // Display the batch name and create edit and delete buttons for each batch
          echo "<tr>";
          echo "<td>" . $row['batch_name'] . "</td>";
          echo "</tr>";

          // Create a link to the page that lists semesters for the selected batch
          echo "<tr>";
          echo "<td colspan='2'>";
          echo "<a href='semester_list.php?batch_id=" . $row['batch_id'] . "' class='view-link'>View Semesters</a>";
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

</body>
</html>
