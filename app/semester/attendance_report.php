<?php 
$PAGE_ROLE='ADMIN';
include('../../system/load.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Attendance</title>
    <link rel="stylesheet" href="attendance.css">
</head>
<body>
<?php

if(!isset($_GET['semester_id'])){
    die('ID NOT SET'); 
}

$stmt->prepare("SELECT * FROM `student` WHERE batch_id = (SELECT batch_id FROM `semester` WHERE semester_id = ?) ");
$stmt->bind_param('i', $_GET['semester_id']);
$stmt->execute();
$student =$stmt->get_result();
if($student->num_rows==0){
    die('student not found');
}

if($student->num_rows > 0){
   echo "<table>";
   echo "<tr><th>ROLL NO.</th><th>STUDENT NAME</th><th>Present Days</th><th>Abscent Days</th><th>Percentage</th></tr>";


   while($stu = $student->fetch_assoc()){

    $sql="
    SELECT count( CASE WHEN attendance_status = 'Present' THEN 1 ELSE NULL END) as p_count, count( CASE WHEN attendance_status = 'Abscent' THEN 1 ELSE NULL END) as a_count FROM `attendance_link` where attendance_id in
     ( select attendance_id from attendance where subject_sem_link_id in (select subject_sem_link_id from subject_sem_link where semester_id = ?)) and student_id = ? ;
    ";

    $stmt->prepare($sql);
    $stmt->bind_param('ii', $_GET['semester_id'],$stu['student_id']);
    $stmt->execute();
    $report  =$stmt->get_result();

    $res=$report->fetch_assoc();

    $total_days = $res['p_count']+$res['a_count'];
    $percenteage=0;
    if($res['p_count']!=0){
        $percenteage = ($res['p_count']/$total_days)*100;
    }


        echo "<tr>";
               echo "<td>";
                    echo $stu['roll_no']; 
                      echo "</td>";
                        echo "<td>";
                             echo $stu['student_name'];
                       echo "</td>";
                       echo "<td>";
                            echo $res['p_count'];
                      echo "</td>";
                      echo "<td>";
                           echo $res['a_count'];
                     echo "</td>";
                     echo "<td>";
                          echo round($percenteage)."%";
                    echo "</td>";
}

}