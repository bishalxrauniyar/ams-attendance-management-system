<?php
$PAGE_ROLE = 'TEACHER';
include('../../system/load.php');

if (!isset($_GET['semester_id']) || !isset($_GET['subject_id'])) {
    die('ID NOT SET');
}

$semesterId = $_GET['semester_id'];
$subjectId = $_GET['subject_id'];

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
    $stmt->bind_param('i', $semesterId); 
    $stmt->execute();
    $studentAttendance = $stmt->get_result();

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="attendance_report.xls"');

    echo "ROLL NO.\tSTUDENT NAME\tPRESENT DAYS\tABSENT DAYS\tPERCENTAGE\n";

    while ($row = $studentAttendance->fetch_assoc()) {
        $attendanceQuery = "
            SELECT COUNT(CASE WHEN attendance_status = 'Present' THEN 1 ELSE NULL END) AS p_count,
            COUNT(CASE WHEN attendance_status = 'Abscent' THEN 1 ELSE NULL END) AS a_count
            FROM `attendance_link`
            WHERE attendance_id IN (
                SELECT attendance_id
                FROM attendance
                WHERE subject_sem_link_id IN (
                    SELECT subject_sem_link_id
                    FROM subject_sem_link
                    WHERE semester_id = ?
                    AND subject_id = ?
                )
            )
            AND student_id = ?;
        ";

        $stmtAttendance = $conn->prepare($attendanceQuery);
        $stmtAttendance->bind_param('iii', $semesterId, $subjectId, $row['student_id']);
        $stmtAttendance->execute();
        $attendanceResult = $stmtAttendance->get_result();
        $attendanceData = $attendanceResult->fetch_assoc();

        $total_days = $attendanceData['p_count'] + $attendanceData['a_count'];
        $percentage = 0; // Default value if total days is zero
        if ($total_days !== 0) {
            $percentage = ($attendanceData['p_count'] / $total_days) * 100;
        }

        echo "{$row['roll_no']}\t{$row['student_name']}\t{$attendanceData['p_count']}\t{$attendanceData['a_count']}\t" . round($percentage) . "%\n";
    }
} else {
    echo "Error in preparing the statement: " . $conn->error;
}
?>
