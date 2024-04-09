<?php
$PAGE_ROLE='ADMIN';
require_once('../../system/html_load.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Subject</title>
    <link rel="stylesheet" href="script_addsubject.css">

</head>
<body>
<?php 
                if(isset($_GET['success'])){
                        echo htmlspecialchars($_GET['success']);
                }
            ?>
    <script src="script.js"></script>
    <div class="container">
        <h2>Add Subject</h2>
        <form method="POST" action="add_subject_request.php">
        <input type="text" name="semester_id" value="<?php echo isset($_GET['semester_id']) ? htmlspecialchars($_GET['semester_id']) : ''; ?>" readonly>
            <label for="subject_name">Subject Name:</label>
            <select name="subject_name" id="subject_name">
                <option value=""></option>
                <?php
                $subjectQuery = "SELECT * FROM ams.subject";
                $result = mysqli_query($conn, $subjectQuery);
                $subjects = []; 
                while ($row = mysqli_fetch_assoc($result)) {
                    $subjects[] = $row['subject_name'];
                }
                foreach ($subjects as $subject) {
                    echo '<option value="' . htmlspecialchars($subject) . '">' . htmlspecialchars($subject) . '</option>';
                }
                ?>
            </select>
            <br><br>

    <button class="add-button" onclick="addSemSubject('<?php echo isset($_GET['semester_id']);?>','<?php isset($_GET['subject_id']);?>')">Add Subject</button>

        </form>
    </div>
    <error>
            <?php 
                if(isset($_GET['error'])){
                        echo htmlspecialchars($_GET['error']);
                }
            ?>
            </error>
</body>
</html>