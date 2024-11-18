<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheapDeals - Connecting You with the Best Phones and Plans</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Footer Styles */
        .footer {
            background-color: #990000;
            /* Đỏ đậm */
            color: white;
            /* Chữ trắng */
            padding: 50px 20px;
            text-align: left;
        }

        .footer-top {
            display: flex;
            /* Sử dụng Flexbox */
            align-items: center;
            /* Căn giữa theo chiều dọc */
            margin-bottom: 100px;
        }

        .footer-top .logo img {
            max-width: 150px;
            margin-right: 20px;
            /* Khoảng cách giữa logo và tagline */
        }

        .footer-top .tagline {
            font-size: 18px;
            /* Tăng kích thước chữ */
            line-height: 1.5;
            max-width: 600px;
            /* Giới hạn chiều rộng */
        }

        .footer-features {
            display: flex;
            justify-content: center;
            /* Căn giữa các feature */
            gap: 30px;
            /* Khoảng cách giữa các mục */
            margin-bottom: 100px;
        }

        .feature {
            flex: 1 1 18%;
            /* Mỗi cột chiếm khoảng 18% */
            max-width: 200px;
            /* Giới hạn chiều rộng */
            text-align: center;
        }

        .feature i {
            font-size: 36px;
            /* Kích thước icon */
            margin-bottom: 10px;
        }

        .feature h3 {
            font-size: 20px;
            /* Tăng kích thước chữ cho tiêu đề */
            margin-bottom: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .feature p {
            font-size: 16px;
            /* Tăng kích thước chữ cho mô tả */
            line-height: 1.5;
        }

        .footer-bottom {
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <header class="navbar">
        <div class="container">
            <!-- Logo -->
            <a class="logo" href='index.php'>
                <img src="image/logo.png" alt="Electrophone Logo">
            </a>

            <!-- Navigation Links -->
            <nav class="nav-links">
                <div class="nav-item">
                    <a href="#" class="dropdown-toggle">Mobile <span class="dropdown-arrow">&#9662;</span></a>
                    <div class="dropdown-menu">
                        <div class="column">
                            <h3>Devices</h3>
                            <a href="#">Shop all Phones</a>
                            <a href="#">iPhone</a>
                            <a href="#">Samsung Galaxy Phones</a>
                            <a href="#">Apple</a>
                            <a href="#">Samsung</a>
                            <a href="#">Android</a>
                            <a href="#">Tablet</a>
                            <a href="#">Low-Cost Phones</a>
                        </div>
                        <div class="column">
                            <h3>Plans</h3>
                            <a href="#">Shop SIM Only Plans</a>
                            <a href="#">Add-ons</a>
                            <a href="#">Students</a>
                        </div>
                        <div class="column">
                            <h3>Services</h3>
                            <a href="#">Upgrade your Device</a>
                            <a href="#">Add Another Service</a>
                            <a href="#">Change your Plan</a>
                            <a href="#">International Roaming</a>
                            <a href="#">International Calls</a>
                            <a href="#">Device Care</a>
                            <a href="#">Device safety and security</a>
                            <a href="#">Bundle & Save</a>
                        </div>
                    </div>
                </div>
                <a href="#">Data & Internet <span class="dropdown-arrow">&#9662;</span></a>
                <a href="#">Tablets <span class="dropdown-arrow">&#9662;</span></a>
                <a href="#">My Account <span class="dropdown-arrow">&#9662;</span></a>
                <a href="#">Support <span class="dropdown-arrow">&#9662;</span></a>
            </nav>

            <!-- Icons -->
            <div class="nav-icons">
                <a href="#" class="icon"><i class="fas fa-shopping-cart"></i></a>
                <a href="#" class="icon"><i class="fas fa-search"></i></a>
                <a href="#" class="icon"><i class="fas fa-user"></i></a>
                <a href="login/login.html.php" class="login-button">Login</a> <!-- Thêm nút Đăng nhập -->
            </div>

            <!-- Hamburger menu for mobile -->
            <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <a href="#products" class="cta-button">Shop Now</a>
        </div>
    </section>


    <!-- Include the products section from viewer.html.php -->
    <?php include('viewer.html.php'); ?>

    <!-- Footer -->
    <footer class="footer">
        <!-- Logo and Tagline -->
        <div class="footer-top">
            <div class="logo">
                <img src="image/logo.png" alt="CheapDeal Logo">
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
        </div>
    </footer>


    <!-- JavaScript to handle dropdown menu -->
    <script>
        function toggleMenu() {
            document.querySelector('.navbar').classList.toggle('active');
        }

        // JavaScript để xử lý dropdown menu
        document.querySelectorAll('.dropdown-toggle').forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault();

                // Đóng tất cả các dropdown khác trước khi mở cái mới
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== this.nextElementSibling) {
                        menu.classList.remove('show');
                    }
                });

                // Mở dropdown menu tương ứng
                const dropdownMenu = this.nextElementSibling;
                dropdownMenu.classList.toggle('show');
            });
        });

        // Đóng dropdown menu khi nhấn ra ngoài
        window.addEventListener('click', function(event) {
            if (!event.target.closest('.nav-item')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });
    </script>

</body>

</html>