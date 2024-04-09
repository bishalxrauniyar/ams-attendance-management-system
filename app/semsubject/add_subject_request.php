<?php
$PAGE_ROLE = "ADMIN";
require_once('../../system/load.php');
// Check if the form is submitted
if(empty($_POST)){
    header('location: add_subject_request.php');
    die;
}
$subjectId='';
if (isset($_POST['semester_id']) && isset($_POST['subject_name'])) {
    
  
    
    // Validation and sanitization
  
    $semesterId = test_input('semester_id', 'add_subject_request.php');
    $subjectName = test_input('subject_name','add_subject_request.php');
    
    
    // $subjectId = test_input('subject_id' , 'add_subject_request.php');
    // die("HELLO");
    
    if (empty($subjectName)) {
        forward('add_subject.php',['error' =>'Empty subject' ,'semester_id' => $semesterId]);
        die;
    } 
  
//subject xa ki nai check gareko
    $stmt = $conn->prepare("SELECT subject_id FROM ams.subject WHERE subject_name = ?");
    $stmt->bind_param("s", $subjectName);
    $stmt->execute();
    $subjectresult= $stmt->get_result();
   
    if ($subjectresult->num_rows > 0) {
        $row=$subjectresult->fetch_assoc();
        $subjectId=$row['subject_id'];
       
    }
    else{
        forward('add_subject.php',['error', 'Invalid subject ID']);
        exit;
    }

    //subject table ko subject id snga subject sem link to subject id milxa ki nai vnera check greko
    $stmt1 = $conn->prepare("SELECT subject_id FROM ams.subject_sem_link WHERE semester_id = ? and subject_id=?");
$stmt1->bind_param("ii", $semesterId,$subjectId);
$stmt1->execute();
$semsubresult = $stmt1->get_result();
$stmt1->close();

if ($semsubresult->num_rows > 0) { 
    forward('add_subject.php', ['error' => 'Subject already exists', 'semester_id' => $semesterId]);
    exit;
}
    // Perform the insertion of the subject into the link table
    $stmt2 = $conn->prepare("INSERT INTO ams.subject_sem_link (semester_id, subject_id) VALUES (?, ?)");
    $stmt2->bind_param('ii', $semesterId, $subjectId);


    if ($stmt2->execute()) {
        forward('sem_subject_list.php', ['success'=>'Subject added successfully','semester_id' => $semesterId]);
        die;
    } else {
        forward('add_subject.php',['error'=>'Error adding subject: ' . $stmt2->error, 'semester_id' => $semesterId]);
        die;
    }
} else {
    die("LAST PAGE ERROR");
}
?>
