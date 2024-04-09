<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        /* Additional responsive styles can be added here */
    </style>
</head>
<body>
    <div class="user">
        <a href="#">TOTAL USERS</a>
        <?php
        $sql = "SELECT COUNT(*) AS total_users FROM user";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalusers = $row['total_users'];
            echo "Total Users: " . $totalusers;
        } else {
            echo "No users found";
        }
        ?>
    </div>
    <div class="faculty">
        <a href="#">TOTAL FACULTY</a>
        <?php
        $sql = "SELECT COUNT(*) AS total_department FROM department";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total_department = $row['total_department'];
            echo "Total Departments: " . $total_department;
        } else {
            echo "No faculty found";
        }
        ?>
    </div>
    <div class="class">
        <a href="#">TOTAL CLASSES</a>
        <?php
        $sql = "SELECT COUNT(*) AS total_class FROM department";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalclass = $row['total_class'];
            echo "Total Classes: " . $totalclass;
        } else {
            echo "No classes found";
        }
        ?>
    </div>
</body>
</html>
