<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        th {
            background-color: #4CAF50;
            color: white;
        }
        
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Additional responsive styles can be added here */
        @media (max-width: 768px) {
            h1 {
                font-size: 24px;
            }
            .container {
                max-width: 100%;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <script>
        function editDivert(id) {
            window.location.assign("../user/user_edit_index.php?id="+id);
        }
    </script>
    <?php
    // Establishing a connection
    $PAGE_ROLE = 'ADMIN';
    include('../../system/load.php');
    
    if (isset($_POST['search'])) {
        // Get the search query from the form
        $username = $_POST['username'];
    
        // Prepare the query to search for a username
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
    
        // Get the result
        $result = $stmt->get_result();
    
        // Check if any rows were returned
        if($result->num_rows > 0) {
            // Display the results
            echo "<div class='container'>";
            echo "<h1>Attendance Management System</h1>";
            echo "<table>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>Username:</td><td>" . $row['username'] . "</td></tr>";
                echo "<tr><td>Email:</td><td>" . $row['email'] . "</td></tr>";
                echo "<tr><td>Phone Number:</td><td>" . $row['phone_no'] . "</td></tr>";
                echo "<tr><td>EDIT BUTTON:</td><td><button onclick='editDivert(\"".$row['user_id']."\");'> EDIT " . $row['username'] . "</td></tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='container'>";
            echo "<h1>No results found.</h1>";
            echo "</div>";
        }
    
        // Close the statement
        $stmt->close();
    }
    ?>
</body>
</html>
