<?php
require_once '../include/database.php';
require_once '../include/databasefunction.php';
//search.html.php
// Nhận từ khóa tìm kiếm từ URL
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : ''; // Trim whitespace

// Gọi hàm tìm kiếm sản phẩm từ cơ sở dữ liệu
$devices = getAllDevices($searchQuery);
$packages = getAllPackages($searchQuery);
$services = getAllServices($searchQuery); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../styles.css"> <!-- Ensure styles are included -->

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 100px;
            background-color: #f1f1f1;

        }

        .section-heading {
            font-size: 40px;
            text-align: center;
            color: red;
            margin-left: 30px;
            margin-bottom: 10px;
            text-decoration: underline;
        }

        .product-container {
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
            max-width: 100%;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 50px;
        }

        .product-grid {
            display: flex;
            gap: 1.5rem;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 20px;
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
            height: 370px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        /* Tên sản phẩm, giá và mô tả */
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

        /* Sold count */
        .sold-count {
            font-size: 1rem;
            color: #666;
            margin-top: 5px;
            margin-left: 70%;
        }
    </style>
</head>

<body>
    <h1>Search Results for: <?= htmlspecialchars($searchQuery) ?></h1>

    <h2>Devices</h2>
    <div class="product-container">
        <?php if ($devices): ?>
            <?php foreach ($devices as $device): ?>
                <div class="product-card">
                    <div class="product-header">
                        <div class="product-category"><?= htmlspecialchars($device['category']); ?></div>
                        <div class="product-stock">Available: <?= htmlspecialchars($device['stock']) ?></div>
                    </div>
                    <a href="detail_device.php?device_id=<?= $device['device_id']; ?>">
                        <img src="<?= '../image/imagedevice/' . htmlspecialchars($device['image']); ?>" alt="<?= htmlspecialchars($device['name']); ?>">
                    </a>
                    <a href="detail_device.php?device_id=<?= $device['device_id']; ?>">
                        <h3 class="product-name"><?= htmlspecialchars($device['name']); ?></h3>
                    </a>
                    <p class="product-price">Price: $<?= htmlspecialchars(number_format($device['price'], 2)); ?></p>
                    <p class="product-description"><?= htmlspecialchars($device['description']); ?></p>
                    <div class="offer">
                        <span class="icon">🎁</span> Discount up to 15% when ordering via app
                    </div>
                    < <p class="sold-count">Sold: <?= htmlspecialchars($device['sales_count']) ?> units</p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No devices available.</p>
        <?php endif; ?>
    </div>

    <h2>Packages</h2>
    <div class="product-container">
        <?php if ($packages): ?>
            <?php foreach ($packages as $package): ?>
                <div class="product-card">
                    <a href="detail_package.php?package_id=<?= $package['package_id']; ?>">
                        <img src="<?= '../image/packetimage/' . htmlspecialchars($package['image']); ?>" alt="<?= htmlspecialchars($package['name']); ?>">
                    </a>
                    <a href="detail_package.php?package_id=<?= $package['package_id']; ?>">
                        <h3 class="product-name"><?= htmlspecialchars($package['name']); ?></h3>
                    </a>
                    <p class="product-price">Price: $<?= htmlspecialchars(number_format($package['price'], 2)); ?></p>
                    <p class="product-description"><?= htmlspecialchars($package['description']); ?></p>
                    <div class="offer">
                        <span class="icon">🎁</span> Discount up to 15% when ordering via app
                    </div>
                    <p class="sold-count">Sold: <?= htmlspecialchars($package['sales_count']) ?> units</p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No packages available.</p>
        <?php endif; ?>
    </div>

    <h2>Services</h2>
    <div class="product-container">
        <?php if ($services): ?>
            <?php foreach ($services as $service): ?>
                <div class="product-card">
                    <a href="detail_service.php?service_id=<?= $service['service_id']; ?>">
                        <img src="<?= '../image/serviceimage/' . htmlspecialchars($service['image']); ?>" alt="<?= htmlspecialchars($service['name']); ?>">
                    </a>
                    <a href="detail_service.php?service_id=<?= $service['service_id']; ?>">
                        <h3 class="product-name"><?= htmlspecialchars($service['name']); ?></h3>
                    </a>
                    <p class="product-price">Price: $<?= htmlspecialchars(number_format($service['price'], 2)); ?></p>
                    <p class="product-description"><?= htmlspecialchars($service['description']); ?></p>
                    <div class="offer">
                        <span class="icon">🎁</span> Discount up to 15% when ordering via app
                    </div>
                    <p class="sold-count">Sold: <?= htmlspecialchars($service['sales_count']) ?> units</p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No services available.</p>
        <?php endif; ?>
    </div>
</body>

</html>