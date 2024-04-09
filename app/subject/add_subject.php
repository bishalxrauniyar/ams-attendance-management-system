<?php
$PAGE_ROLE='ADMIN';
include('../../system/load.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Subject</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            color: #4CAF50;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <error>
            <?php 
                if(isset($_GET['error'])){
                        echo htmlspecialchars($_GET['error']);
                }
            ?>
            </error>
    <div class="container">
        <h2>Add Subject</h2>
        <form method="POST" action="subject_request.php">
            <input type="hidden" name="semester_id" value="<?php echo $semesterId; ?>">
            <label for="subjectName">Subject Name:</label>
            <input type="text" id="subjectName" name="subject_name" required>
            <br><br>
            <input type="submit" value="Add">
        </form>
    </div>
    <success>
    <?php
    if(isset($_GET['success']))
    {
        echo htmlspecialchars($_GET['success']);
       }
    ?>
    </success>
</body>
</html>
