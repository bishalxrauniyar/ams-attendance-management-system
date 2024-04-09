<?php
$PAGE_ROLE = 'TEACHER';
include('../../system/load.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Select Semester</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
    max-width: 900px;
    padding: 15px;
    margin: 0vh 10vw;
    }

    h1 {
      text-align: center;
      color: #4CAF50;
      margin-bottom: 30px;
    }

    ul {
      list-style-type: none;
      padding: 0;
    }

    li {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-bottom: 10px;
      padding: 20px;
      transition: background-color 0.3s;
    }

    li:hover {
      background-color: #f2f2f2;
    }

    li a {
      text-decoration: none;
      color: #4CAF50;
    }

    .button-container {
      text-align: center;
      margin-top: 20px;
    }

    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      margin-right: 10px;
    }

    .button:hover {
      background-color: #45a049;
    }
     
    .message {
  padding: 10px;
  margin-bottom: 10px;
  font-weight: bold;
}

.message.success {
  background-color: #dff0d8;
  color: #3c763d;
}

.message.error {
  background-color: #f2dede;
  color: #a94442;
}
  </style>
</head>

<body>
  <div class="container">
    <?php
    // To check if the batch ID is provided
    if (isset($_GET['batch_id'])) {
      $batch_id = $_GET['batch_id'];

      // Fetch data from the "semester" table for the selected batch
      $query = "SELECT semester.semester_id, semester.semester_name, batch.batch_name, department.dep_name
      FROM semester
      JOIN batch ON semester.batch_id = batch.batch_id
      JOIN department ON batch.dep_id = department.dep_id
      WHERE batch.batch_id = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("i", $batch_id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        echo "<h1>Select Semester</h1>";
        echo "<ul>";

        while ($row = $result->fetch_assoc()) {
          // Display the semester name with edit and delete buttons
          echo "<li>";
          echo "<h2><a href='sem_subject_list.php?semester_id=" . $row['semester_id'] . "&batch_id=" . $batch_id . "'>" . $row['semester_name'] . "</a></h2>";
          echo "<a class='button' href='attendance_report.php?semester_id=" . $row['semester_id'] . "'>REPORT</a>";
          echo "</li>";
        }
        echo "</ul>";
      } else {
        echo "<h1>No Semesters Found</h1>";
       
      }
    }
    ?>
  </div>
</body>
</html>
