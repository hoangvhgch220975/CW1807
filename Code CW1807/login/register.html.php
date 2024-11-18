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
            /* Tăng padding trên để có khoảng cách cho logo */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo {
            position: absolute;
            top: 15px;
            /* Điều chỉnh vị trí logo */
            left: -0pc;
            /* Điều chỉnh vị trí logo */
            width: 120px;
            /* Tăng kích thước logo */
            opacity: 0.5;
            /* Giảm độ đậm để logo mờ đi */
        }

        .form h1 {
            margin-top: 40px;
            /* Tạo khoảng cách giữa logo và tiêu đề */
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
    </style>
</head>

<body>
    <form class="form">
        <img src="../image/logo.png" alt="Logo" class="logo">
        <h1>Sign <span>Up</span></h1>
        <input type="text" placeholder="Name">
        <input type="text" placeholder="Username">
        <input type="password" placeholder="Password">
        <input type="text" placeholder="Email">
        <input type="text" placeholder="Address">
        <input type="text" placeholder="Phone Number">
        <input type="text" placeholder="Credit Card">
        <input type="submit" value="Sign up" class="button">
    </form>
</body>

</html>