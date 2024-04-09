<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Department List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
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
    max-width: 800px;
    margin: 0 auto 40px;
    padding: 20px;
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
    text-decoration: none;
    display: inline-block;
    margin: 5px;
  }

  .add-button:hover,
  .edit-button:hover,
  .delete-button:hover {
    background-color: #45a049;
  }

  .add-button {
    margin: 20px auto;
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
    <h1>Student List</h1>
    <?php
    if(isset($_GET['batch_id'])){
    $batchId=$_GET['batch_id'];

    $batchQuery="SELECT * FROM ams.student where batch_id=$batchId";
    $result=$conn->query($batchQuery);
    if($result->num_rows > 0){
        echo "<table>";
        echo "<tr><th>Student Name</th><th>Roll no</th><th>Actions</th></tr>";
        while($row=$result->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row['student_name'] . "</td>";
            echo "<td>" . $row['roll_no'] . "</td>";
            echo "<td>";
            echo "<button class='edit-button' onclick='editStudent(" . $row['student_id'] . ")'>Edit </button> |";
            echo "<button class='delete-button' onclick='deleteStudent(" . $row['student_id'] . ")'> Delete </button>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "No Students Found";
    }
    }
    ?>
  </div>

  <a href="../student/add_student.php" class="add-button">Add Student</a>

  <script>
    function editStudent(student_id,batch_id) {
      window.location.href = '../student/edit_student.php?batch_id=' + batch_id + ' &student_id='+ student_id;
    }

    function deleteStudent(student_id) {
      window.location.href = '../student/delete_student.php?student_id=' + student_id ;
    }
  </script>
</body>
</html>
