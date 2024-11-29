<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password - CheapDeals</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #cc0000;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .wrapper {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }

        .left-section {
            flex: 1;
            padding: 40px;
            text-align: center;
            background-color: #cc0000;
            color: white;
        }

        .left-section img {
            max-width: 150px;
            height: auto;
            margin-bottom: 20px;
        }

        .left-section h1 {
            font-size: 48px;
            color: white;
            margin: 0;
        }

        .left-section p {
            font-size: 18px;
            color: #f5f5f5;
        }

        .right-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .forgot-password-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .forgot-password-container h2 {
            margin: 0 0 20px;
            color: #333;
        }

        .forgot-password-container input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .forgot-password-container .button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background-color: #cc0000;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .forgot-password-container .button:hover {
            background-color: #a30000;
        }

        .forgot-password-container a {
            display: block;
            margin-top: 10px;
            color: #cc0000;
            text-decoration: none;
        }

        .forgot-password-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <form action="../customer/forgetpass.php" method="POST">
        <div class="wrapper">
            <div class="left-section">
                <img src="../image/logo.jpg" alt="CheapDeals Logo" />
                <h1>CheapDeals</h1>
                <p>Your go-to platform for the best deals in electronics, mobile phones, and more!</p>
            </div>

            <div class="right-section">
                <div class="forgot-password-container">
                    <h2>Forgot Password</h2>
                    <form action="forgotpassword.php" method="POST">
                        <input type="email" name="email" placeholder="Recovery email" required />
                        <button class="button" type="submit">Reset Password</button>
                    </form>
                    <a href="../login/login.html.php">Back to login</a>
                </div>
            </div>
        </div>
    </form>
</body>

</html>