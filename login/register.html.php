<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #8b1515;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .form {
            position: relative;
            background-color: #ffffff;
            padding: 40px 20px 30px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo {
            position: absolute;
            top: 15px;
            left: -0pc;
            width: 120px;
            opacity: 0.5;
        }

        .form h1 {
            margin-top: 16px;
            font-size: 32px;
            color: #333;
        }

        .form h1 span {
            color: #8b1515;
        }

        .form input[type="text"],
        .form input[type="password"],
        .form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form .button {
            background-color: #8b1515;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 4px;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form .button:hover {
            background-color: #7a1313;
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        .form .button:active {
            background-color: #6a1010;
            transform: translateY(0);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .mt-6 {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <form class="form" method="POST" action="register.php">
        <img src="../image/logo.jpg" alt="Logo" class="logo">
        <h1>Sign <span>Up</span></h1>
        
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <div class="mt-6 text-center">
            <a href="login.php" class="text-[black] hover:underline">Already have an account? Login</a>
        </div>
        <button type="submit" class="button">Sign Up</button>
    </form>

    <script>
        // Check for error or success messages in the URL
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');
        const success = urlParams.get('success');

        if (error) {
            alert(decodeURIComponent(error));
        }

        if (success) {
            alert(decodeURIComponent(success));
        }
    </script>
</body>
</html>