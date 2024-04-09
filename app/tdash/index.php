<?php
$PAGE_ROLE='TEACHER';
$conn=require_once('../../system/html_load.php');
?>
<html>
  <head>
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
  </head>
  <body>
    <div class="admin">
      <div class="admin-title">Teacher Dashboard</div>
      
      <a href="../login"><button class="logout">Logout</button></a>
    </div>
    <div class="nav-bar">
      <a href="department_list.php" class="active" onclick="selectNavLink(event,'department_list.php')" target="myFrame">Attendance</a>
     
    </div>



    <div class="relative">
    <iframe class="iframe" id="myFrame" name="myFrame"></iframe>
    </div>
  </body>
</html>
