<?php
$PAGE_ROLE ='TEACHER';
include('../../system/load.php');
?>
 
<?php
 $query = "SELECT * FROM ams.attendance";
 $result = $conn->query($query);
if($result->num_rows > 0)
{
    echo "table";
    echo "<tr><th>Student Name</th></tr>";
    while($row=$result->fetch_assoc())
{
    


}
}
?>