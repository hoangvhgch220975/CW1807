<?php
// detail_device.html.php
require_once '../include/database.php';
require_once '../include/databasefunction.php';

// Check if the device_id is set in the URL
if (!isset($_GET['device_id']) || empty($_GET['device_id'])) {
    echo "Device ID is missing.";
    exit;
}

$deviceId = intval($_GET['device_id']); // Get the device_id from the URL
$product = getDeviceById($deviceId); // Fetch product details using the provided ID

if (!$product) {
    echo "Product not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']); ?> - Product Details</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .product-details-container {
            max-width: 1200px;
            margin: 50px auto;
            display: flex;
            position: relative;
            gap: 30px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 150px;
        }

        .product-image {
            flex: 2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image img {
            max-width: 100%;
            max-height: 500px;
            border-radius: 10px;
        }

        .product-info {
            flex: 3;
            display: flex;
            flex-direction: column;
            gap: 15px;
            position: relative;
        }

        .product-info h1 {
            font-size: 2rem;
            margin: 0;
            color: #333;
        }

        .category {
            position: absolute;
            top: 0;
            right: 0;
            font-weight: bold;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .star {
            color: gold;
            font-size: 1.5rem;
        }

        .price-stock {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .price {
            font-size: 1.5rem;
            color: #d81920;
        }

        .stock {
            font-size: 1.2rem;
            color: #333;
        }

        .details {
            background: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 10px;
            flex-grow: 1;
        }

      
    </style>
</head>

<body>
    <div class="product-details-container">
        <div class="product-image">
            <img src="../image/imagedevice/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
        </div>
        <div class="product-info">
            <h1><?= htmlspecialchars($product['name']); ?></h1>
            <div class="category"><?= htmlspecialchars($product['category']); ?></div>
            <?php if ($product['star_rating']): ?>
                <div class="rating">
                    <strong>Rating:</strong>
                    <?php for ($i = 0; $i < $product['star_rating']; $i++): ?>
                        <span class="star">★</span>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
            <div class="details"><strong>Description:</strong> <?= htmlspecialchars($product['description']); ?></div>
            <div class="price-stock">
                <div class="price">Price: $<?= htmlspecialchars(number_format($product['price'], 2)); ?></div>
                <div class="stock">Stock: <?= htmlspecialchars($product['stock']); ?> units available</div>
            </div>
            <form action="../customer/add_to_cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['device_id']); ?>">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']); ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($product['price']); ?>">
                <input type="hidden" name="image" value="<?= htmlspecialchars($product['image']); ?>">
                <input type="hidden" name="quantity" value="1" min="1" required>
            </form>

        </div>
    </div>

</body>

</html>