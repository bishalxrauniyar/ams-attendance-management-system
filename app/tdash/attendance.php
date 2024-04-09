<?php
$PAGE_ROLE ='TEACHER';
include('../../system/load.php');

if(!isset($_GET['subject_sem_link_id'])){
    die('ID NOT SET'); 
}

$stmt->prepare("SELECT * FROM `student` WHERE batch_id = (SELECT batch_id FROM `semester` WHERE semester_id = (select semester_id from subject_sem_link where subject_sem_link_id=?))");
$stmt->bind_param('i', $_GET['subject_sem_link_id']);
$stmt->execute();
$student =$stmt->get_result();
if($student->num_rows==0){
    die('student not found');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Attendance</title>
    <success id="message">
    <?php 
                if(isset($_GET['success'])){
                        echo htmlspecialchars($_GET['success']);
                }
            ?>
</success>
    <link rel="stylesheet" href="attendance.css">
</head>
<body>
    <h2>Record Student Attendance</h2>
    <form action="attendance_request.php" method="post">
        <input type='hidden' name='subject_sem_link_id' value="<?php echo $_GET['subject_sem_link_id']; ?>" >
        <table>
        <tr>
                    <th>Roll No</th>
                    <th>Student Name</th>
                    <th>Attendance</th>
                </tr>
                <?php
                while($stu = $student->fetch_assoc()){
                ?>
                <tr>
                <td>
                            <?php echo $stu['roll_no']; ?>
                        </td>
                        <td>
                            <?php echo $stu['student_name']; ?>
                        </td>
                       
     
                    <td class="attendance-options">
                    <label>
                            <input type="radio" name="attendance_status<?php echo $stu['student_id'];?>" value="Present" id="present_<?php echo $stu['student_id'];?>">
                            <span class="radio-custom"></span> Present
                        </label>
                        <label> 
                            <input type="radio" name="attendance_status<?php echo $stu['student_id'];?>" value="Abscent" id="absent_<?php echo $stu['student_id'];?>">
                            <span class="radio-custom"></span> Absent
                        </label>
                    </td>
                </tr>
                <?php 
                }
                ?>
            </table>
        
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>