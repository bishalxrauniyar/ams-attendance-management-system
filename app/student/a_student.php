<?php
$PAGE_ROLE = 'ADMIN';
include('../../system/load.php');
?>

<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search = $conn->real_escape_string($search); // Sanitize user input
$sql = "SELECT * FROM student WHERE (student_name LIKE '%$search%' OR email LIKE '%$search%' OR phone_no LIKE '%$search%')";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .search-form {
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            padding: 8px;
            width: 200px;
        }

        .search-form input[type="submit"] {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .action-button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 3px;
            transition: background-color 0.3s, transform 0.3s;
            margin-right: 5px;
        }

        .action-button:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h2>Student List</h2>
    <form class="search-form" method="GET">
        <input type="text" name="search" placeholder="Search by Student name, email, or phone number" value="<?php echo $search; ?>">
        <input type="submit" value="Search">
    </form>
    <table>
        <tr>
            <th>Student Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Roll Number</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        <?php
        // Loop through the fetched data and display in table rows
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['student_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone_no'] . "</td>";
                echo "<td>" . $row['roll_no'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>";
                echo "<a class='action-button' href='edit_student.php?student_id=".$row['student_id']."'>Edit</a>";
                echo "<a class='action-button' href='delete_student.php?student_id=" . $row['student_id'] . "'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No students found</td></tr>";
        }
        ?>
    </table>
    <br>
    <a class="action-button" href="add_student.php">Add Student</a>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
