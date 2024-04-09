<?php
$PAGE_ROLE = "TEACHER";
include('../../system/load.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Subject List</title>
    <link rel="stylesheet" href="subject.css">
    <style>
        /* Add some basic styling to the buttons */
        .action-button {
            display: inline-block;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            margin-right: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }

        /* Add a hover effect */
        .action-button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }
    </style>
</head>
<h1>Subject List</h1>
<body>
<script src="script.js"></script>
<div class="container">
    <?php
    if (isset($_GET['semester_id'])) {
        $semesterId = $_GET['semester_id'];
        $query = "SELECT *, (SELECT subject_name FROM ams.subject WHERE subject_id = semlink.subject_id) AS name FROM ams.subject_sem_link semlink WHERE semester_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $semesterId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Subject Name</th><th>Actions</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>";
                echo "<a class='action-button' href='attendance.php?subject_sem_link_id=" . $row['subject_sem_link_id'] . "'>Take Attendance</a>";
                echo "<a class='action-button' href='subjectwise_attendance_report.php?subject_id=" . $row['subject_id'] . "&semester_id=" . $row['semester_id'] . "'>Report</a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No Subjects Found";
        }
    } else {
        echo "Invalid Semester ID";
    }
    ?>

</div>
</body>
</html>
