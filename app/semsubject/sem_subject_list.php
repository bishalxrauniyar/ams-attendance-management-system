<?php
$PAGE_ROLE="ADMIN";
include('../../system/load.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Subject List</title>
  <link rel="stylesheet" href="style.css">
</head>
<h1>Subject List</h1>
<body>
<script src="script.js"></script>
<div class="container">
<?php
        if (isset($_GET['semester_id'])) {
            $semesterId = $_GET['semester_id'];



            $query = "SELECT * FROM ams.subject WHERE subject_id IN (SELECT subject_id FROM ams.subject_sem_link WHERE semester_id = ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $semesterId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Subject Name</th><th>Actions</th></tr>";

                while ($row = $result->fetch_assoc()) {



                    echo "<tr>";
                    echo "<td>" . $row['subject_name'] . "</td>";
                    echo "<td>";
                    echo "<button class='delete-button' onclick='deleteSemSubject(" . $row['subject_id'] . ")'>Delete</button>";
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
   <button class="add-button" onclick="addSubject(<?php echo isset($_GET['semester_id']) ? htmlspecialchars($_GET['semester_id']) : ''; ?>)">Add Subject</button>
   <script>
   function deleteSemSubject(subject_id) {
    // Redirect to the delete_subject.php page with the subject ID as a URL parameter
    window.location.href = 'delete_sem_subject.php?subject_id=' + subject_id;
  }
  </script>
    </body>
</html>

