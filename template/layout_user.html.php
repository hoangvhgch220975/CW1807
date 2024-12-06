<!DOCTYPE html>
<html lang="en">
<!-- layout.html.php -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheapDeals - Connecting You with the Best Phones and Plans</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Navigation Bar Styles */
        .navbar {
            background-color: #fff;
            display: flex;
            justify-content: space-between;
            /* Phân bố không gian đều giữa các phần tử */
            align-items: center;
            padding: 10px 20px;
            /* Thêm padding cho navbar */
        }

        .navbar .logo {
            margin-right: auto;
            /* Đẩy logo sát trái */
        }

        .navbar .logo img {
            max-width: 80px;
            width: auto;
            height: auto;
            margin-right: 200px;
        }

        /* Navigation Links Styles */
        .nav-links {
            display: flex;
            gap: 20px;
            flex-grow: 1;
            /* Giúp phần tử này chiếm không gian còn lại */
            justify-content: center;
            /* Căn giữa các thanh điều hướng */
        }

        .nav-links a {
            font-size: 20px;
            padding: 10px 15px;
            display: flex;
            align-items: center;
        }

        /* Icons and Login Button Styles */
        .nav-icons {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            /* Đẩy các icon và nút login sang bên phải */
        }

        .nav-icons a.icon {
            font-size: 40px;
            /* Kích thước icon */
        }

        /* Ẩn dropdown menu mặc định */
        .nav-icons .dropdownicon-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            padding: 10px;
            z-index: 1000;
            width: 250px;
        }

        /* Hiển thị menu khi có class 'show' */
        .nav-icons .dropdownicon-menu.show {
            display: block;
            margin-left: 80%;
        }

        /* Hiển thị menu theo cột */
        .nav-icons .dropdownicon-menu .col {
            display: flex;
            flex-direction: column;
        }

        .dropdownicon-menu a {
            color: #333;
            text-decoration: none;
            padding: 8px 0;
            transition: background 0.3s ease;
        }

        .dropdownicon-menu a:hover {
            color: #d81920;
        }

        .dropdownicon-menu a:hover {
            background-color: #f9f9f9;
        }

        .nav-icons .icon:hover {
            color: #0073e6;
            /* Màu khi hover */
            transform: scale(1.2);
            /* Phóng to biểu tượng khi hover */
        }

        .logout-button {
            font-size: 16px;
            color: #fff;
            background-color: #d81920;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-left: 20px;
            /* Khoảng cách bên trái với icon */
            transition: background 0.3s ease;
        }

        .login-button:hover {
            background-color: #cc0000;
        }

        /* Tìm kiếm */
        .search-container {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            align-items: center;
            margin-left: 20%;
            padding-right: 5%;
        }

        .search-form {
            display: flex;
            align-items: center;
        }

        .search-input {
            padding: 12px;
            font-size: 18px;
            border: 1px solid #ccc;
            border-radius: 20px;
            width: 250px;
        }

        .search-btn {
            background-color: #990000;
            color: white;
            border: none;
            padding: 12px 16px;
            border-radius: 20px;
            cursor: pointer;
            margin-left: 18px;
        }

        .search-btn:hover {
            background-color: #cc0000;
        }

        .search-input:focus {
            outline: none;
            border-color: #990000;
        }



        .logout-button:hover {
            background-color: #cc0000;
        }

        .dropdown-arrow {
            margin-left: 5px;
            /* Khoảng cách giữa chữ và mũi tên */
            font-size: 14px;
            /* Kích thước mũi tên (có thể điều chỉnh) */
        }

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
            width: 100%;
            /* Độ rộng 100% của logo */
            height: auto;
            /* Chiều cao tự động */
            margin-right: 20px;
            /* Khoảng cách giữa logo và tagline */
        }

        .footer-top .tagline {
            font-size: 18px;
            /* Tăng kích thước chữ */
            line-height: 1.5;
            max-width: 600px;
            /* Giới hạn chiều rộng */
            margin-right: 58%;
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

        .submenu {
            padding: 20px;
            /* Add some padding around the submenu */
        }

        .submenu-container {
            display: flex;
            justify-content: space-around;
            /* Space out the cards evenly */
            flex-wrap: wrap;
            /* Allow cards to wrap to the next line if necessary */
        }

        .submenu-card {
            background-color: #f9f9f9;
            /* Background color for the card */
            border-radius: 8px;
            /* Rounded corners */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            text-align: center;
            /* Center text and image */
            padding: 20px;
            /* Increase padding for larger cards */
            margin: 10px;
            /* Space between cards */
            width: 200px;
            /* Set a fixed width for the cards */
            transition: transform 0.3s;
            /* Smooth transition for hover effect */
        }

        .submenu-card img {
            width: 80px;
            /* Increase image size */
            height: auto;
            /* Maintain aspect ratio */
            margin-bottom: 10px;
            /* Space between image and text */
        }

        .submenu-card a {
            font-size: 18px;
            /* Increase font size for links */
            color: #333;
            /* Link color */
            text-decoration: none;
            /* Remove underline */
        }

        .submenu-card:hover {
            transform: scale(1.05);
            /* Slightly enlarge card on hover */
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <header class="navbar">
        <div class="container">
            <!-- Logo -->
            <a class="logo" href='../customer/index_user.php'>
                <img src="../image/logo.png" alt="Electrophone Logo">
            </a>

            <!-- Navigation Links -->
            <nav class="nav-links">
                <div class="nav-item">
                    <a href="#" class="dropdown-toggle">Mobile <span class="dropdown-arrow">&#9662;</span></a>
                    <div class="dropdown-menu">
                        <div class="column">
                            <h3>Devices</h3>
                            <a href="../customer/all_mobile.php">Shop all Phones</a>
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
                <a href="#">Support <span class="dropdown-arrow">&#9662;</span></a>
            </nav>

            <!-- Icons -->


            <!-- Tìm kiếm -->
            <!-- Search Form -->
            <div class="search-container">
                <form action="../customer/search.php" method="get" class="search-form">
                    <input type="text" name="search" placeholder="Search for products..." class="search-input" />
                    <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <!-- Icons -->
            <div class="nav-icons">
                <a href="../template/cart.html.php" class="icon"><i class="fas fa-shopping-cart"></i></a>

                <div class="dropdown">
                    <a href="#" class="icon dropdown-toggle"><i class="fas fa-user"></i></a>
                    <div class="dropdownicon-menu">
                        <div class='col'>
                            <a href="../customer/profile.php">Profile</a>
                            <a href="../customer/order_history.php">Purchase History</a>
                        </div>
                    </div>
                </div>

                <a href="../login/logout.php" class="logout-button">LogOut</a> <!-- Thêm nút Đăng xuất -->


                <!-- Hamburger menu for mobile -->
                <div class="menu-toggle" onclick="toggleMenu()">☰</div>
            </div>
    </header>


    <main class="main">
        <div class="main">
            <?= $output; ?>
        </div>
    </main>
    <!-- Footer -->
    <footer class="footer">
        <!-- Logo and Tagline -->
        <div class="footer-top">
            <div class="logo">
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
        </div>
    </footer>


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

        // Đóng dropdownicon menu khi nhấn ra ngoài
        window.addEventListener('click', function(event) {
            if (!event.target.closest('.nav-icons')) {
                document.querySelectorAll('.dropdownicon-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });
    </script>

</body>

</html>