<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOD Login</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(-45deg, #FF007A, #9C27B0, #2196F3, #FF007A);
            background-size: 400% 400%;
            animation: colorShift 15s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes colorShift {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        .login-container {
            padding: 20px;
            background: rgba(0, 0, 0, 0.75); /* Adjusted for consistency */
            border-radius: 10px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            color: white;
            margin-bottom: 20px;
        }

        input[type=text], input[type=email], input[type=password], input[type=tel] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: rgba(255,255,255,0.5);
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #2196F3;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0d8bf2;
        }

        .forgot-password {
            color: #ddd;
            text-decoration: none;
            display: block;
            margin-top: 15px;
        }

        .forgot-password:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>HOD Login</h2>
    <form action="d_1.php" method="post">
        <input type="text" id="dept_id" name="dept_id" placeholder="Department ID" required>
        <input type="email" id="email_id" name="email_id" placeholder="Email ID" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <a href="#" class="forgot-password">Forgot Password?</a>
    </form>
</div>
</body>
</html>
<script>
    function showForgotPassword() {
        // Implement forgot password logic as necessary
    }
</script>

</body>
</html>