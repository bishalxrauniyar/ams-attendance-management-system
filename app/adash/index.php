<?php
$PAGE_ROLE = 'ADMIN';
$conn = require_once('../../system/html_load.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>
 
<body>
    <div class="admin">
        <div class="admin-title">Admin Dashboard</div>
        <div class="toggle-container">
            <input type="checkbox" id="night-mode-toggle">
            <label for="night-mode-toggle" class="toggle-label"></label>
        </div>
        <form class="search-form" method="POST" action="search.php">
            <label for="username"></label>
            <input type="text" name="username" required placeholder="Search user">
            <input type="submit" name="search" value="Search">
        </form>
        <a href="../login"><button class="logout">Logout</button></a>
    </div>
    <div class="nav-bar">
        <a href="dashboard.php" class="nav_link" onclick="selectNavLink(event,'dashboard.php')" target="myFrame">Dashboard</a>
        <a href="../student/a_student.php" class="nav_link" onclick="selectNavLink(event,'a_student.php')" target="myFrame">Student</a>
        <a href="../department/department_list.php" class="nav_link" onclick="selectNavLink(event,'department_list.php')" target="myFrame">Department</a>
        <a href="../user" class="nav_link" onclick="selectNavLink(event,'user.php')" target="myFrame">Add User</a>
        <a href="../subject/subject_list.php" class="nav_link" onclick="selectNavLink(event,'subject_list.php')" target="myFrame">Subject</a>
        
    </div>
   
    <div class="contain"></div>

    <div class="relative">
        <iframe class="iframe" id="myFrame" name="myFrame"></iframe>
    </div>

    <script>
        const nightModeToggle = document.getElementById("night-mode-toggle");
        const body = document.body;
        const adminContainer = document.querySelector(".admin");
        const navBar = document.querySelector(".nav-bar");

        nightModeToggle.addEventListener("change", () => {
            body.classList.toggle("night-mode");
            adminContainer.classList.toggle("night-mode");
            navBar.classList.toggle("night-mode");
        });

    </script>

</body>
</html>
