<?php
$PAGE_ROLE='STUDENT';
$conn=require_once('../../system/html_load.php');
?>
<html>
  <head>
    <title>Student Dashboard</title>
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
    
      <a href="../login"><button class="logout">Logout</button></a>
    </div>
    <div class="nav-bar">
      <a href="dashboard.php" class="nav_link" onclick="selectNavLink(event,'dashboard.php')" target="myFrame">Dashboard</a>
      <a href="../student/a_student.php"class="nav_link"  onclick="selectNavLink(event,'a_student.php')" target="myFrame">Generate report</a>
    </div>
   
    <div class="contain"> </div>

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
