<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Area Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Navigation Bar Styles */
        .navbar {
            background-color: #fff;
            display: flex;
            align-items: center;
            padding: 5px 20px;
            /* Reduced padding */
            border-bottom: 1px solid #ccc;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            /* Align items vertically */
            margin-right: auto;
        }

        .navbar .logo img {
            max-width: 80px;
            width: auto;
            height: auto;
        }

        .navbar .logo span {
            margin-left: 10px;
            /* Adjusted margin */
            font-size: 24px;
            /* Adjusted font size */
            font-weight: bold;
            color: #333;
            /* Color for the title */
        }

        /* Navigation Links Styles */
        .nav-links {
            display: flex;
            gap: 15px;
            /* Reduced gap */
        }

        .nav-links a {
            font-size: 18px;
            /* Reduced font size */
            padding: 8px 12px;
            /* Reduced padding */
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color: #f0f0f0;
        }

        /* Icons and Logout Button Styles */
        .nav-icons {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .nav-icons a.icon {
            font-size: 40px;
            color: #333;
        }

        .logout-button {
            font-size: 16px;
            color: #fff;
            background-color: #d81920;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .logout-button:hover {
            background-color: #cc0000;
        }

        /* Main Content Styles */
        main {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 5%;
            margin-bottom: 5%;
        }

        /* Footer Styles */
        .footer {
            background-color: #990000;
            color: white;
            padding: 50px 20px;
            text-align: left;
        }

        .footer-top {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .footer-top .logo img {
            max-width: 150px;
            height: auto;
            margin-right: 20px;
        }

        .footer-top .tagline {
            font-size: 18px;
            line-height: 1.5;
            max-width: 600px;
        }

        .footer-features {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
        }

        .feature {
            text-align: center;
        }

        .feature i {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .feature h3 {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .feature p {
            font-size: 16px;
            line-height: 1.5;
        }

        .footer-bottom {
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo" style="display: flex; align-items: center;"> <!-- Set display to flex and align items -->
            <a href="../admin/index_admin.php" style="display: flex; align-items: center; text-decoration: none; color: inherit;"> <!-- Wrap the logo and title in an anchor tag -->
                <img src="../image/logo.png" alt="Logo" style="max-width: 80px; height: auto; margin-right: 10px;"> <!-- Add margin to the right of the logo -->
                <span style="font-size: 24px; font-weight: bold;">Admin Panel</span>
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="nav-links">
            <a href="../admin/index_admin.php">Home</a>
            <a href="#">User </a>
            <a href="#">Device</a>
            <a href="#">Service</a>
            <a href="#">Package</a>
            <a href="../login/logout.php" class="logout-button">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <h1 class="text-3xl font-semibold text-gray-900">Dashboard</h1>
        <p class="text-gray-600">Manage your platform settings and users from this area.</p>
        <!-- Dynamic Content Area (where PHP will render dynamic content) -->
        <?= $output; ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-top">
            <div class="logo">
                <a href="../admin/index_admin.php">
                    <img src="../image/logo.png" alt="CheapDeal Logo">
            </div>
            <p class="tagline">Revolutionizing Affordable Connectivity for Everyone. Bringing you faster service, better deals, and real-time account management – all in one place.</p>
        </div>

        <!-- Features Section -->
        <div class="footer-features">
            <div class="feature">
                <i class="fas fa-user-circle"></i>
                <h3>Seamless Real-Time Account Management</h3>
                <p>Stay in control anytime, anywhere. Update personal details, view usage, and settle bills effortlessly.</p>
            </div>
            <div class="feature">
                <i class="fas fa-tags"></i>
                <h3>Exclusive Discounts for App Users</h3>
                <p>Save 15% on every order through our app. Unlock more discounts tailored to your preferences.</p>
            </div>
            <div class="feature">
                <i class="fas fa-headset"></i>
                <h3>Enhanced Customer Support</h3>
                <p>Get instant responses via our CRM system. No more long waits for issue resolutions.</p>
            </div>
            <div class="feature">
                <i class="fas fa-cogs"></i>
                <h3>Customized Deals and Packages</h3>
                <p>Create your perfect bundle of mobile, broadband, or tablet services to suit your needs.</p>
            </div>
            <div class="feature">
                <i class="fas fa-credit-card"></i>
                <h3>Instant Payments and Receipts</h3>
                <p>Hassle-free transactions with instant email receipts for your records.</p>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; 2024 CheapDeal. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>