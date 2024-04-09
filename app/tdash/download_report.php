<?php
$PAGE_ROLE = 'TEACHER';
include('../../system/load.php');

if (!isset($_GET['semester_id'])) {
    die('ID NOT SET');
}
$studentsQuery = "
    SELECT s.student_id, s.roll_no, s.student_name
    FROM student s
    WHERE s.batch_id = (
        SELECT batch_id
        FROM semester
        WHERE semester_id = ?
    )
";

$stmt = $conn->prepare($studentsQuery);
if ($stmt) {
    $stmt->bind_param('i', $_GET['semester_id']); 
    $stmt->execute();
    $studentAttendance = $stmt->get_result();

    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="attendance_report.xls"');

   
    echo "ROLL NO.\tSTUDENT NAME\tPRESENT DAYS\tABSENT DAYS\tPERCENTAGE\n";

    while ($row = $studentAttendance->fetch_assoc()) {
        
        $attendanceQuery = "
            SELECT
                SUM(CASE WHEN attendance_status = 'Present' THEN 1 ELSE 0 END) as present_days,
                SUM(CASE WHEN attendance_status = 'Abscent' THEN 1 ELSE 0 END) as abscent_days
            FROM attendance_link al
            JOIN attendance a ON al.attendance_id = a.attendance_id
            WHERE al.student_id = ?
            AND a.subject_sem_link_id IN (
                SELECT subject_sem_link_id
                FROM subject_sem_link
                WHERE semester_id = ?
            )
        ";

        $stmtAttendance = $conn->prepare($attendanceQuery);
        $stmtAttendance->bind_param('ii', $row['student_id'], $_GET['semester_id']);
        $stmtAttendance->execute();
        $attendanceResult = $stmtAttendance->get_result();
        $attendanceData = $attendanceResult->fetch_assoc();

        $total_days = $attendanceData['present_days'] + $attendanceData['abscent_days'];
        $percentage = 0; // Default value if total days is zero
        if ($total_days !== 0) {
            $percentage = ($attendanceData['present_days'] / $total_days) * 100;
        }

        echo "{$row['roll_no']}\t{$row['student_name']}\t{$attendanceData['present_days']}\t{$attendanceData['abscent_days']}\t" . round($percentage) . "%\n";
    }
} else {
    echo "Error in preparing the statement: " . $conn->error;
}
?>