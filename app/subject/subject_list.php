<?php
$PAGE_ROLE = "ADMIN";
include('../../system/load.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Subject List</title>
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
    max-width: 800px;
    margin: 0px 0px 15px 15vw;
    padding: 3px;
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
</head>
<h1>Subject List</h1>
<body>
<div class="container">
<?php
  $query = "SELECT * FROM ams.subject";
  $result=$conn->query($query);
  if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Subject Name</th><th>Actions</th></tr>";
  
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['subject_name'] . "</td>";
      echo "<td>";
      echo "<button class='edit-button' onclick='editSubject(" . $row['subject_id'] . ")'>Edit</button> | ";
      echo "<button class='delete-button' onclick='deleteSubject(" . $row['subject_id'] . ")'>Delete</button>";
      echo "</td>";
      echo "</tr>";
    }
  
    echo "</table>";
  } else {
    echo "No Subjects Found";
  }

  ?>
   </div>
  <button class="add-button" onclick="addSubject()">Add Subject</button>
  
  <script>
    function editSubject(subject_id) {
      // Redirect to the edit_subject.php page with the subject ID as a URL parameter
      window.location.href = 'edit_subject.php?subject_id=' + subject_id;
    }
  
    function deleteSubject(subject_id) {
      // Redirect to the delete_subject.php page with the subject ID as a URL parameter
      window.location.href = 'delete_subject.php?subject_id=' + subject_id;
    }
  
    function addSubject() {
      // Redirect to the add_subject.php page
      window.location.href = 'add_subject.php';
    }
  </script>
</body>
</html>
