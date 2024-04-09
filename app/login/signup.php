<!DOCTYPE html>
<html>
<head>
    <title>Signup Page</title>
    
<style>
        body {
            background-image: url("signupbg.jpg");
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: linear-gradient(140deg, #f5f5f5, #9ca3af);
            max-width: 400px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            
            display: flex;
            flex-direction: column;
        }

        .form-group {
            
            margin-bottom: 20px;
        }

        label {
            font-size: 18px;
            color: #555;
            display: block;
            text-align: left;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="email"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 92%;
            font-size: 17px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #4285F4;
            outline: none;
        }

        input[type="submit"] {
            background-color: #4285F4;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #3367D6;
        }

        .text-center {
            text-align: center;
            font-size: 16px;
            color: #666;
        }

        a {
            color: #4285F4;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #3367D6;
        }
    </style>
</head>
<body>
   
    <div class="container">
        <h1>Signup</h1>
        <form action="process_signup_request.php" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="roll_no">Roll No</label>
                <input type="text" id="roll_no" name="roll_no" required>
            </div>

            <div class="form-group">
                <label for="phone_no">Phone Number</label>
                <input type="text" id="phone_no" name="phone_no" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>

            <input type="hidden" name="role" value="Student">

            <input type="submit" value="Sign Up">
        </form>

        <p class="text-center">Already have an account? <a href="login.php">Login</a></p>
   
    </div>

</body>
</html>



