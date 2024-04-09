<?php
$PAGE_ROLE = 'TEACHER';
include('../../system/load.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Attendance</title>
    <link rel="stylesheet" href="attendance.css">
    <style>
        /* Add some basic styling to the button */
        .download-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }

        /* Add a hover effect */
        .download-button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<?php

if (!isset($_GET['semester_id']) || !isset($_GET['subject_id'])) {
    die('IDs NOT SET');
}

$semester_id = $_GET['semester_id'];
$subject_id = $_GET['subject_id'];

$stmt = $conn->prepare("SELECT * FROM `student` WHERE batch_id = (SELECT batch_id FROM `semester` WHERE semester_id = ?)");
$stmt->bind_param('i', $semester_id);
$stmt->execute();
$student = $stmt->get_result();

if ($student->num_rows == 0) {
    die('Student not found');
}

if ($student->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ROLL NO.</th><th>STUDENT NAME</th><th>Present Days</th><th>Absent Days</th><th>Percentage</th></tr>";

    while ($stu = $student->fetch_assoc()) {
        $sql = "
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

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii', $semester_id, $subject_id, $stu['student_id']);
        $stmt->execute();
        $report = $stmt->get_result();
        $res = $report->fetch_assoc();

        $total_days = $res['p_count'] + $res['a_count'];
        $percentage = 0;
        if ($total_days != 0) {
            $percentage = ($res['p_count'] / $total_days) * 100;
        }

        echo "<tr>";
        echo "<td>" . $stu['roll_no'] . "</td>";
        echo "<td>" . $stu['student_name'] . "</td>";
        echo "<td>" . $res['p_count'] . "</td>";
        echo "<td>" . $res['a_count'] . "</td>";
        echo "<td>" . round($percentage) . "%</td>";
        echo "</tr>";
    }

    echo "</table>";
}

// Add the "Download Report" button
echo '<div style="text-align: center; margin-top: 20px;">';
echo '<a class="download-button" href="subject_wise_report_download.php?semester_id=' . $semester_id . '&subject_id=' . $subject_id . '">Download Report</a>';
echo '</div>';
?>
</body>
</html>
