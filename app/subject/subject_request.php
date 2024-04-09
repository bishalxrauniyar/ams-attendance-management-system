<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
if(empty($_POST)){
    forward('index.php');
    die;
}

    if (isset($_POST['subject_name'])) {
      $subjectName=test_input('subject_name','add_subject.php');

     if(empty($subjectName))
     {
        forward('add_subject.php',['error'=>'Empty Subject Name']);
     } 

     $stmt = $conn->prepare("SELECT subject_name FROM ams.subject WHERE subject_name = ? limit 1");
     $stmt->bind_param('s', $subjectName);
     $stmt->execute();
     $result =$stmt->get_result();

     if($result->num_rows > 0){
         forward('add_subject.php',['error'=>'Subject already exist']);
         die;
     }
            $query = "INSERT INTO ams.subject (subject_name) VALUES (?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $subjectName);
            // Execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to the subject list page with semester_id as a query parameter
                forward('add_subject.php',['success'=>'Subject Added Successfully','subject_name'=>'$subjectName']);
                exit();
            } else {
                echo "Error adding subject: " . $stmt->error;
            }
        } 

?>
