<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
?>

<html>
  <head>
    <style>
       
    .message {
  padding: 10px;
  margin-bottom: 10px;
  font-weight: bold;
  text-align: center;
  font-size:20px;
  margin-left:87px;
}

.message.success {
  background-color: #dff0d8;
  color: #179d19;
}

.message.error {
  background-color: #f2dede;
  color: #a94442;
}
   </style>
    <head>
</html>
<?php
$semesterId=null;
$semesterName='';

if(isset($_GET['semester_id'])) {
  $semesterId = $_GET['semester_id'];

  $query = "SELECT * FROM ams.semester WHERE semester_id=?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $semesterId);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if($result->num_rows > 0) {
    $semester = $result->fetch_assoc();
    $semesterName = $semester['semester_name'];
  } 
}
if($_SERVER['REQUEST_METHOD']=== 'POST'){
  // Delete the associated subjects first
  $deleteSemQuery = "DELETE FROM ams.semester WHERE semester_id = ?";
  $stmt = $conn->prepare($deleteSemQuery);
  $stmt->bind_param("i", $semesterId);
    if ($stmt->execute()) {
      forward('delete_semester.php',['success'=>'SUCESSFULLY DELETED']);
      exit;
    } else {
      forward('delete_semester.php',['error'=>'ERROR DELETING SEMESTER']);
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
    <h2>Delete Semester (ID: <?php echo $semesterId; ?>)</h2>
    <p>Are you sure you want to delete the Semester "<?php echo $semesterName; ?>"?</p>
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
