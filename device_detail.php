<?php
// detail_device.html.php
require_once 'include/database.php';
require_once 'include/databasefunction.php';

// Check if the device_id is set in the URL
if (!isset($_GET['device_id']) || empty($_GET['device_id'])) {
    echo "Device ID is missing.";
    exit;
}

$deviceId = intval($_GET['device_id']); // Get the device_id from the URL
$product = getDeviceById($deviceId); // Fetch product details using the provided ID
$allComments = getAllComments(); // Fetch all comments

if (!$product) {
    echo "Product not found.";
    exit;
}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']); ?> - Product Details</title>
    <link rel="stylesheet" href="styles.css">
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

        .cta-buttons {
            margin-top: 20px;
        }

        .cta-buttons a {
            text-decoration: none;
            background: #d81920;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
        }

        .cta-buttons a:hover {
            background: #b5151c;
        }

        .customer-feedback {
            margin-top: 20px;
            padding: 20px;
            background: #f2f2f2;
            border-radius: 5px;
            width: calc(100% - 40px);
        }

        .customer-feedback h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .back-to-products {
            position: absolute;
            top: 10px;
            left: 10px;
            text-decoration: none;
            background: #333;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
        }

        .back-to-products:hover {
            background: #555;
        }

        .comment-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .comment-item img {
            width: 40px;
            height: 40px;
            margin-right: 15px;
        }

        .comment-content {
            flex: 1;
        }

        .comment-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .comment-text {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <a class="back-to-products" >←</a>
    <div class="product-details-container">
        <div class="product-image">
            <img src="image/imagedevice/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
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
            <div class="cta-buttons">
                <a href="#">Add to Cart</a>
            </div>
        </div>
    </div>

    <div class="customer-feedback">
        <h2>Customer Feedback</h2>
        <?php if ($allComments && count($allComments) > 0): ?>
            <?php foreach ($allComments as $comment): ?>
                <div class="comment-item">
                    <img src="image/user-icon.png" alt="User  Icon">
                    <div class="comment-content">
                        <div class="comment-header">
                            <strong><?= htmlspecialchars($comment['reviewer']); ?></strong>
                            <?php for ($i = 0; $i < $comment['star_rating']; $i++): ?>
                                <span class="star">★</span>
                            <?php endfor; ?>
                        </div>
                        <div class="comment-text"><?= htmlspecialchars($comment['comment']); ?></div>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No customer feedback available for this product .</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php 
$output = ob_get_clean();
include 'template/layout.html.php';
?>