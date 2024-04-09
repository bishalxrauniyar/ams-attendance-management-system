<?php
$PAGE_ROLE = 'TEACHER';
include('../../system/load.php');
if(empty($_POST)){
    forward('attendance.php');
    die;
}

$index_page='attendance.php';

            $subject_sem_link_id=test_input('subject_sem_link_id',$index_page,'POST',['subject_sem_link_id'=>$subject_sem_link_id]);
            $teacherId = $_SESSION['user_id'];

            $stmt->prepare("SELECT * FROM `student` WHERE batch_id = (SELECT batch_id FROM `semester` WHERE semester_id = (select semester_id from subject_sem_link where subject_sem_link_id=?))");
            $stmt->bind_param('i', $subject_sem_link_id);
            $stmt->execute();
            $student =$stmt->get_result();
            if($student->num_rows==0){
                die('student not found');
            }

            /* attendance tabel create garne**/ 
            $stmt->prepare("INSERT INTO ams.attendance(attendance_date, teacher_id, subject_sem_link_id) VALUES (now(), ?, ?)");
            $stmt->bind_param('ii', $teacherId, $subject_sem_link_id);
            $stmt->execute();
            $attendanceId = $stmt->insert_id;// last ma insert gareko id tane 

            while ($stu = $student->fetch_assoc()) {
                
                $studentId = $stu['student_id'];
                $attendanceStatusValue = test_input('attendance_status' . $studentId, $index_page,'POST',['subject_sem_link_id'=>$subject_sem_link_id]);
                $stmt->prepare("INSERT INTO ams.attendance_link(attendance_id, student_id, attendance_status) VALUES (?, ?, ?)");
                $stmt->bind_param('iis', $attendanceId, $studentId, $attendanceStatusValue);
                  if($stmt->execute()){
                forward('attendance.php',['subject_sem_link_id'=>$subject_sem_link_id,'success'=>'Attendance Successfully Taken']);
            }
            else{
                forward('attendance.php',['subject_sem_link_id'=>$subject_sem_link_id,'error'=>'Error Taking Attendance']);
            }
            }
        
