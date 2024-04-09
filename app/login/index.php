<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
	
</head>
<body>
	<div class="container">
		<h1>Attendance Management System</h1>
		<form action="login.php" method="post">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
			<input type="submit" value="Login">
		</form>
		
	</div>
</body>
</html>
