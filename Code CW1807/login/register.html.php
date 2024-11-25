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
            margin-top: 40px;
            font-size: 24px;
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
        }

        .form .button:hover {
            background-color: #7a1313;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <form class="form" method="POST" action="register.html.php">
        <img src="../image/logo.jpg" alt="Logo" class="logo">
        <h1>Sign <span>Up</span></h1>
        <?php if (!empty($error)) : ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if (!empty($success)) : ?>
            <p class="success"><?= htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <input type="text" name="full_name" placeholder="Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="email" placeholder="Email" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="phone_number" placeholder="Phone Number" required>
        <input type="text" name="credit_card_number" placeholder="Credit Card">
        <div class="mt-6 text-center">
            <a href="login.php" class="text-[black] hover:underline">Already have an account? Login</a>
        </div>
        <input type="submit" value="Sign up" class="button">
    </form>
</body>

</html>

