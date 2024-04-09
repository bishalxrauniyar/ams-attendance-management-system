<?php
$PAGE_ROLE='STUDENT';
$conn=require_once('../../system/load.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATTENDANCE MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="contain.css">
</head>
<body>
    <div class="container">
        <h1>Attendance Management System</h1>
        <?php
    $conn=include('../../system/database.php');
      // Perform a query to retrieve the user with the given username
    $query="SELECT * FROM student where role='STUDENT'";
    $result= mysqli_query($conn,$query);
    if($result){
    echo "<table>
    <tr>
          <th>student_id</th>
          <th>Students Name</th>
          <th>PHONE NO</th>
          <th>ROLE</th>
          </tr>";

          if($row =mysqli_fetch_assoc($result)){

            
            echo "<tr>
                    <td>".$row["user_id"]."</td>
                    <td>".$row["username"]."</td>                                                          
                    <td>".$row["phone_no"]."</td>
                    <td>".$row["role"]."</td>
                </tr>";}
                echo "</table>";
          }
     else {
        echo "No attendance records found.";
     }
    ?>
</div>
</body>
</html>
