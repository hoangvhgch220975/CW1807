<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - CheapDeals</title>
  <style>
    /* Base styling */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #cc0000;
      /* Red background */
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    /* Wrapper for two-column layout */
    .wrapper {
      display: flex;
      width: 100%;
      max-width: 1000px;
      background-color: #ffffff;
      border-radius: 8px;
      /* Bo góc cho toàn bộ wrapper */
      overflow: hidden;
      /* Giúp che các góc bo */
    }

    /* Left section styling */
    .left-section {
      flex: 1;
      padding: 40px;
      text-align: center;
      background-color: #cc0000;
      /* Red background */
      color: white;
    }

    .left-section img {
      max-width: 150px;
      /* Limit logo size */
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

    /* Right section with login form */
    .right-section {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: white;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .login-container {
      width: 100%;
      max-width: 400px;
      padding: 30px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      text-align: center;
    }

    .login-container h2 {
      margin: 0 0 20px;
      color: #333;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .login-container .button {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      background-color: #cc0000;
      /* Red button */
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
      /* Thêm hiệu ứng chuyển đổi */
    }

    .login-container .button:hover {
      background-color: #a30000;
    }

    .login-container .social-login img {
      width: 50px;
      /* Đặt chiều rộng cho các logo */
      height: 50px;
      /* Đặt chiều cao cho các logo để đảm bảo chúng bằng nhau */
      margin: 10px;
      cursor: pointer;
      object-fit: cover;
      /* Đảm bảo logo giữ nguyên tỷ lệ mà không bị biến dạng */
    }

    .login-container a {
      display: block;
      margin-top: 10px;
      color: #cc0000;
      text-decoration: none;
    }

    .login-container a:hover {
      text-decoration: underline;
    }

    /* Định dạng cho phần social-login */
    .social-login {
      display: flex;
      justify-content: center;
      gap: 20px;
      /* Khoảng cách giữa các logo */
      margin-top: 10px;
    }

    /* Logo Google lớn hơn */
    .google-logo {
      width: 70px;
      /* Kích thước logo Google */
      height: 70px;
      cursor: pointer;
      object-fit: cover;
    }

    /* Logo Facebook nhỏ hơn */
    .facebook-logo {
      width: 50px;
      /* Kích thước logo Facebook */
      height: 50px;
      cursor: pointer;
      object-fit: cover;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <!-- Left section with logo and description -->
    <div class="left-section">
      <img src="../image/logo.jpg" alt="CheapDeals Logo" />
      <h1>CheapDeals</h1>
      <p>
        Your go-to platform for the best deals in electronics, mobile phones,
        and more!
      </p>
    </div>

    <!-- Right section with login form -->
    <div class="right-section">
      <form action="login.php" method="POST" class="login-container">
        <h2>Log In</h2>
        <!-- Input fields -->
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />

        <!-- Error message -->
        <?php if (!empty($error)): ?>
          <p class="error" style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <button class="button" type="submit">Log In</button>

        <!-- Social login -->
        <p>Or log in with</p>
        <div class="social-login">
          <a href="https://accounts.google.com/" target="_blank">
            <img src="../image/google.png" alt="Google Login" title="Log in with Google" />
          </a>
          <a href="https://www.facebook.com/login/" target="_blank">
            <img src="../image/facebook.png" alt="Facebook Login" title="Log in with Facebook" />
          </a>
        </div>

        <!-- Additional links -->
        <a href="register.html.php">Don't have an account? Sign up here!</a>
        <a href="#">Forgot password?</a>
      </form>
    </div>
  </div>
</body>

</html>