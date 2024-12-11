<?php
//detail_service.html.php
// Include necessary files for database connection and functions
require_once '../include/database.php';
require_once '../include/databasefunction.php';

// Check if the `service_id` is set in the URL
if (!isset($_GET['service_id'])) {
    echo "Service ID is missing.";
    exit;
}

$serviceId = intval($_GET['service_id']); // Get the `service_id` from the URL
$service = getServiceById($serviceId); // Fetch service details using the provided ID
$serviceDetails = getServiceDetailsById($serviceId); // Fetch service detailed information
$allComments = getAllComments(); // Fetch all comments for the service

// If the service was not found, display an error message
if (!$service || !$serviceDetails) {
    echo "Service not found.";
    exit;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($service['name']); ?> - Service Details</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        /* Layout Styles */
        .service-details-container {
            max-width: 1200px;
            margin: 50px auto;
            display: flex;
            gap: 30px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 150px;
        }

        .service-image {
            flex: 2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .service-image img {
            max-width: 100%;
            max-height: 500px;
            border-radius: 10px;
        }

        .service-info {
            flex: 3;
            display: flex;
            flex-direction: column;
            gap: 15px;
            position: relative;
        }

        /* Service Information */
        .service-info h1 {
            font-size: 2rem;
            margin: 0;
            color: #333;
        }

        .category {
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

        .price {
            font-size: 1.5rem;
            color: #d81920;
        }

        /* Description & Details */
        .details,
        .usage-info {
            background: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
        }

        .cta-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .cta-buttons a {
            text-decoration: none;
            background: #d81920;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        .cta-buttons a:hover {
            background: #b5151c;
        }

        /* Back Button */
        .back-to-homepage,
        .back-to-products {
            position: absolute;
            top: -40px;
            left: 20px;
            text-decoration: none;
            background: #333;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
        }

        .back-to-homepage:hover,
        .back-to-products:hover {
            background: #555;
        }

        /* Customer Feedback */
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

        /* Comment Item */
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

        button[type="submit"] {
            background-color: #d81920;
            /* Nền đỏ */
            color: white;
            /* Màu chữ trắng */
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #b5151c;
            /* Nền đỏ tối hơn khi hover */
        }
    </style>
</head>

<body>
    <a class="back-to-homepage" href="index.php">← Back to Services</a>
    <div class="service-details-container">
        <div class="service-image">
            <?php
            // Check if image exists in the first folder
            $imagePath = '../image/serviceimage/' . htmlspecialchars($service['image'], ENT_QUOTES, 'UTF-8');

            // If image is not found in the first folder, check the second folder
            if (!file_exists($imagePath)) {
                $imagePath = '../upload/' . htmlspecialchars($service['image'], ENT_QUOTES, 'UTF-8');
            }

            // If the image doesn't exist in either folder, use a default image
            if (!file_exists($imagePath)) {
                $imagePath = '../images/default-service.png';
            }
            ?>
            <img src="<?= $imagePath ?>" alt="Service Image" class="device-image">
        </div>
        <div class="service-info">
            <h1><?= htmlspecialchars($service['name']); ?></h1>
            <div class="category">Category: <?= htmlspecialchars($service['package_type']); ?></div>

            <div class="rating">
                <strong>Rating:</strong>
                <?php for ($i = 0; $i < $service['star_rating']; $i++): ?>
                    <span class="star">★</span>
                <?php endfor; ?>
            </div>

            <p class="price">Price: $<?= htmlspecialchars(number_format($serviceDetails['price'], 2)); ?></p>

            <div class="usage-info">
                <p><strong>Call Minutes:</strong> <?= htmlspecialchars($serviceDetails['call_minutes'] ?? 'N/A'); ?> mins</p>
                <p><strong>Data Volume:</strong> <?= htmlspecialchars($serviceDetails['data_volume'] ?? 'N/A'); ?> GB</p>
                <p><strong>Message Count:</strong> <?= htmlspecialchars($serviceDetails['message_count'] ?? 'N/A'); ?> messages</p>
            </div>

            <div class="details">
                <strong>Description:</strong> <?= htmlspecialchars($serviceDetails['description']); ?>
            </div>

            <div class="cta-buttons">
                <!-- <a href="#">Add to Cart</a> -->
                <a href="#">Customize</a>
            </div>
            <form action="../customer/add_to_cart.php" method="POST">
                <input type="hidden" name="service_id" value="<?= htmlspecialchars($service['service_id']); ?>">
                <input type="hidden" name="service_name" value="<?= htmlspecialchars($service['name']); ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($service['price']); ?>">
                <input type="hidden" name="image" value="<?= htmlspecialchars($service['image']); ?>">
                <input type="hidden" name="quantity" value="1" min="1" required>
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    </div>
    <div class="customer-feedback">
        <h2>Customer Feedback</h2>
        <?php if ($allComments && count($allComments) > 0): ?>
            <?php foreach ($allComments as $comment): ?>
                <div class="comment-item">
                    <img src="../image/user-icon.png" alt="User  Icon">
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