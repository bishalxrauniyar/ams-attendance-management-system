<?php
$PAGE_ROLE= "ADMIN";
include('../../system/load.php');
?>

<?php
if(isset($_GET['subject_id'])){
    $subjectId=$_GET['subject_id'];
    // Fetch the subject details based on the ID from the "subject" table
    $query="SELECT * FROM ams.subject where subject_id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i",$subjectId);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $subject=$result->fetch_assoc();
        $subjectName=$subject['subject_name'];
    }
    else{
        header('location:subject_list.php');
        die;
    }
}
    else{
        header('location:subject_list.php');
        die;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $deleteQuery="DELETE FROM ams.subject WHERE subject_id=?";
        $stmt=$conn->prepare($deleteQuery);
        $stmt->bind_param("i",$subjectId);
        
  if ($stmt->execute()) {
    // Redirect back to the batch list page
  header('location:subject_list.php');
    exit;
  } else {
    echo "Error deleting Subject.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete Subject</title>
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
  <h2>Delete Subject (ID: <?php echo $subjectId; ?>)</h2>
  <p>Are you sure you want to delete the Subject "<?php echo $subjectName; ?>"?</p>
  <form method="POST">
    <input type="submit" value="Confirm Delete">
  </form>
  </div>
</body>
</html>
