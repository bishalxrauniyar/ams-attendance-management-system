<?php
$PAGE_ROLE='ADMIN';
require_once('../../system/load.php');

$user_dtl=[];
if(isset($_GET['id'])){
    $id=test_input('id','../adash/','GET');
    // Prepare the query to search for a user
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_id = ?");
    if (!$stmt) {
        // Handle the error here
        echo "Error: " . $conn->error;
        exit;
    }
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows were returned

    if($user_dtl = $result->fetch_assoc()) {

    } else {
        die("USER NOT FOUND");
    }


}else{

    die('GET NOT SET');
}
?>

<html>
    <head>
 <style>
    /* Apply general styling to the whole page */
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

/* Center the container on the page */
.container {
    margin-top: 50px;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Style the form */
.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

select {
    height: 40px;
}

.btn {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Style the error message */
error {
    color: red;
    font-size: 14px;
    margin-top: 10px;
}

/* Center the heading */
h1 {
    text-align: center;
    color: #333;
}

/* Center the page */
center {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

 </Style>
</head>
<body>
<h1>AMS</h1>
<center>
    
    <div class="container">
        <h1 style="color:green;">EDIT USER- <?php echo $user_dtl['username']; ?></h1>
        <?php 
                if(isset($_GET['success'])){
                        echo $_GET['success'];
                }
            ?>
        <form method="POST" action="user_edit_request.php?id=<?php echo $user_dtl['user_id']; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="username" id="username" value="<?php echo $user_dtl['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $user_dtl['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password"  value="<?php echo $user_dtl['password']; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" name="phone_no" id="phone_no"  value="<?php echo $user_dtl['phone_no']; ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" id="role" required selected="<?php echo $user_dtl['role']; ?>">
                    <option value="ADMIN">ADMIN</option>
                    <option value="TEACHER">TEACHER</option>
                </select>
            </div>

            <error>
            <?php 
                if(isset($_GET['error'])){
                        echo $_GET['error'];
                }
            ?>
            </error>
            <div class="form-group">
                <input type="submit" name="adduser" value="EDIT User <?php echo $user_dtl['username']; ?>" class="btn">
            </div>
        </form>
    </div>
    <center>
</body>
</html>
