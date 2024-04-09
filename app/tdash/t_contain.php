<?php
$PAGE_ROLE='TEACHER';
$conn=require_once('../../system/load.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEACHERS ATTENDANCE</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

       <div class="container"></div>
        <h1>Teachers Attendance</h1>
        <?php

  $conn=require_once('../../system/database.php');
      
        $sql="SELECT * FROM user";
        $result= mysqli_query($conn, $sql);
        if($result->num_rows > 0){
            echo "<table>
            <tr>
              <th>User id</th>
              <th>email</th>
              <th>phone_no</th>
              <th>role</th>
              
              </tr>";
              if ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["user_id"]."</td>
                        <td>".$row["email"]."</td>                                                          
                        <td>".$row["phone_no"]."</td>
                        <td>".$row["role"]."</td>
                    </tr>";}
                    echo "</table>";
            
              }
else{
    echo "No attendance records available";
}
$conn->close();
    ?>
</div>
</body>
</html>


<?php


/*
$query = "SELECT * FROM your_table";


$result = $conn->query($query);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
       
        $column1 = $row["column1"];
        $column2 = $row["column2"];
        
        
        
        echo "Column 1: " . $column1 . "<br>";
        echo "Column 2: " . $column2 . "<br>";
       
    }
} else {
    echo "No results found.";
}

*/
$conn->close();

?>
