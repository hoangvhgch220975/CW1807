<?php
// Bao gồm các file cần thiết
require_once 'include/database.php';
require_once 'include/databasefunction.php';

// Gọi hàm để lấy tất cả thiết bị
$devices = getAllDevices();
$services = getAllServices();
$packages = getAllPackages();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devices</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* CSS cho phần Products với thanh cuộn ngang */
        .product-container {
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
            max-width: 100%;
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .product-grid {
            display: flex;
            gap: 1.5rem;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 20px;
            margin: 0 auto;
            max-width: 90%;
            scrollbar-width: none;
        }

        .product-grid::-webkit-scrollbar {
            display: none;
        }

        .product-card {
            position: relative;
            min-width: 250px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            text-align: left;
            flex-shrink: 0;
        }

        .product-card img {
            width: 100%;
            height: 380px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .products-heading {
            text-align: left;
            font-size: 50px;
            margin-bottom: 20px;
            margin-left: 250px;
            color: red;
        }

        /* Thẻ chứa category và stock */
        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        /* Hiển thị category */
        .product-category {
            background-color: gray;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 1rem;
            color: #fff;
            font-weight: bold;
            margin-right: 200px;
        }

        /* Hiển thị số lượng có sẵn */
        .product-stock {
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 1.5rem;
        }

        /* Tên sản phẩm, giá, và mô tả */
        .product-name {
            font-size: 1.2rem;
            font-weight: bold;
            margin: 0;
        }

        .product-price {
            font-size: 1.1rem;
            color: #333;
            margin: 0.5rem 0;
        }

        .product-description {
            font-size: 0.9rem;
            color: #666;
            margin-top: 0.5rem;
        }

        /* Offer section */
        .offer {
            font-size: 0.9rem;
            color: #333;
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        /* Sold count */
        .sold-count {
            font-size: 1rem;
            color: #666;
            margin-top: 5px;
            margin-left: 70%;
        }

        .arrow-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 0, 0, 0.7);
            color: #fff;
            border: none;
            padding: 15px;
            cursor: pointer;
            font-size: 24px;
            z-index: 1;
            border-radius: 50%;
        }

        .left-arrow {
            left: 25px;
        }

        .right-arrow {
            right: 5px;
        }

        .arrow-btn:hover {
            background-color: rgba(200, 0, 0, 0.9);
        }

        .arrow-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>

<body>

    <!-- Products Section -->
    <section class="products" id="products">
        <h2 class="products-heading">Best Seller🔥🔥🔥</h2>

        <div class="product-container">
            <button class="arrow-btn left-arrow disabled" onclick="scrollLeftCustom()">&#9664;</button>

            <div class="product-grid" id="productGrid">
                <?php if ($devices): ?>
                    <?php foreach ($devices as $device): ?>
                        <div class="product-card">
                            <!-- Header chứa Category và Stock -->
                            <div class="product-header">
                                <div class="product-category"><?= htmlspecialchars($device['category']); ?></div>
                                <div class="product-stock">Available: <?= htmlspecialchars($device['stock']) ?></div>
                            </div>

                            <!-- Ảnh sản phẩm -->
                            <img src="<?= 'image/' . htmlspecialchars($device['image']); ?>" alt="<?= htmlspecialchars($device['name']); ?>">

                            <!-- Tên sản phẩm -->
                            <h3 class="product-name"><?= htmlspecialchars($device['name']); ?></h3>

                            <!-- Giá sản phẩm -->
                            <p class="product-price">Price: $<?= htmlspecialchars(number_format($device['price'], 2)); ?></p>

                            <!-- Mô tả sản phẩm -->
                            <p class="product-description"><?= htmlspecialchars($device['description']); ?></p>

                            <!-- Thông báo giảm giá -->
                            <div class="offer">
                                <span class="icon">🎁</span> Discount up to 15% when ordering via app
                            </div>

                            <!-- Số lượng đã bán -->
                            <p class="sold-count">Sold: <?= htmlspecialchars($device['sales_count']) ?> units</p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products available.</p>
                <?php endif; ?>
            </div>

            <button class="arrow-btn right-arrow" onclick="scrollRightCustom()">&#9654;</button>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <h2 class="products-heading">Our Services 🌟</h2>

        <div class="product-container">
            <button class="arrow-btn left-arrow disabled" onclick="scrollLeftService()">&#9664;</button>

            <div class="product-grid" id="serviceGrid">
                <?php if ($services): ?>
                    <?php foreach ($services as $service): ?>
                        <div class="product-card">
                            <!-- Tên dịch vụ -->
                            <h3 class="product-name"><?= htmlspecialchars($service['name']); ?></h3>

                            <!-- Mô tả dịch vụ -->
                            <p class="product-description"><?= htmlspecialchars($service['description']); ?></p>

                            <!-- Giá dịch vụ -->
                            <p class="product-price">Price: $<?= htmlspecialchars(number_format($service['price'], 2)); ?></p>

                            <!-- Số lượng có sẵn -->
                            <p class="product-stock">Available: <?= htmlspecialchars($service['stock']) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No services available.</p>
                <?php endif; ?>
            </div>

            <button class="arrow-btn right-arrow" onclick="scrollRightService()">&#9654;</button>
        </div>
    </section>


    <!-- Packages Section -->
    <section class="packages" id="packages">
        <h2 class="products-heading">Our Packages 📦</h2>

        <div class="product-container">
            <button class="arrow-btn left-arrow disabled" onclick="scrollLeftPackage()">&#9664;</button>

            <div class="product-grid" id="packageGrid">
                <?php if ($packages): ?>
                    <?php foreach ($packages as $package): ?>
                        <div class="product-card">
                            <!-- Tên gói -->
                            <h3 class="product-name"><?= htmlspecialchars($package['name']); ?></h3>

                            <!-- Mô tả gói -->
                            <p class="product-description"><?= htmlspecialchars($package['description']); ?></p>

                            <!-- Giá gói -->
                            <p class="product-price">Price: $<?= htmlspecialchars(number_format($package['price'], 2)); ?></p>

                            <!-- Số lượng đã bán -->
                            <p class="sold-count">Sold: <?= htmlspecialchars($package['sales_count']) ?> units</p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No packages available.</p>
                <?php endif; ?>
            </div>

            <button class="arrow-btn right-arrow" onclick="scrollRightPackage()">&#9654;</button>
        </div>
    </section>


</body>

<script>
    const productGrid = document.getElementById('productGrid');
    const leftArrow = document.querySelector('.left-arrow');
    const rightArrow = document.querySelector('.right-arrow');

    // Cập nhật trạng thái các nút cuộn
    function updateArrows() {
        const atStart = productGrid.scrollLeft === 0;
        const atEnd = productGrid.scrollLeft >= (productGrid.scrollWidth - productGrid.clientWidth);

        leftArrow.classList.toggle('disabled', atStart);
        rightArrow.classList.toggle('disabled', atEnd);
    }

    function scrollLeftCustom() {
        if (productGrid.scrollLeft > 0) {
            productGrid.scrollBy({
                left: -500,
                behavior: 'smooth'
            });
        }
    }

    function scrollRightCustom() {
        const maxScrollLeft = productGrid.scrollWidth - productGrid.clientWidth;
        if (productGrid.scrollLeft < maxScrollLeft) {
            productGrid.scrollBy({
                left: 500,
                behavior: 'smooth'
            });
        }
    }

    productGrid.addEventListener('scroll', updateArrows);
    window.addEventListener('load', updateArrows);
    updateArrows();



    const serviceGrid = document.getElementById('serviceGrid');
    const packageGrid = document.getElementById('packageGrid');

    function scrollLeftService() {
        serviceGrid.scrollBy({
            left: -300,
            behavior: 'smooth',
        });
    }

    function scrollRightService() {
        serviceGrid.scrollBy({
            left: 300,
            behavior: 'smooth',
        });
    }

    function scrollLeftPackage() {
        packageGrid.scrollBy({
            left: -300,
            behavior: 'smooth',
        });
    }

    function scrollRightPackage() {
        packageGrid.scrollBy({
            left: 300,
            behavior: 'smooth',
        });
    }
</script>

</html>
