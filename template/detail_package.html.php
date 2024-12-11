<?php
// Include necessary files for database connection and functions
require_once '../include/database.php';
require_once '../include/databasefunction.php';

// Check if the `package_id` is set in the URL
if (!isset($_GET['package_id'])) {
    echo "Package ID is missing.";
    exit;
}

$packageId = intval($_GET['package_id']); // Get the `package_id` from the URL
$package = getPackageById($packageId); // Fetch package details using the provided ID
$allComments = getAllComments($packageId); // Fetch all comments for the specific package

// If the package was not found, display an error message
if (!$package) {
    echo "Package not found.";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($package['name']); ?> - Package Details</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .package-details-container {
            max-width: 1200px;
            margin: 50px auto;
            display: flex;
            gap: 30px;
            position: relative;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 150px;
        }

        .package-image {
            flex: 2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .package-image img {
            max-width: 100%;
            max-height: 500px;
            border-radius: 10px;
        }

        .package-info {
            flex: 3;
            display: flex;
            flex-direction: column;
            gap: 15px;
            position: relative;
        }

        .package-info h1 {
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

        .price {
            position: absolute;
            bottom: 20px;
            right: 20px;
            font-size: 1.5rem;
            color: #d81920;
        }

        .details {
            background: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .quantity-info,
        .usage-info {
            background: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
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
            width: 100%;
        }

        .customer-feedback h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }



        .back-to-homepage:hover {
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
    <a class="back-to-homepage" href="index.php">←</a>
    <div class="package-details-container">
        <div class="package-image">
            <?php
            // Check if image exists in the first folder
            $imagePath = '../image/packetimage/' . htmlspecialchars($package['image'], ENT_QUOTES, 'UTF-8');

            // If image is not found in the first folder, check the second folder
            if (!file_exists($imagePath)) {
                $imagePath = '../upload/' . htmlspecialchars($package['image'], ENT_QUOTES, 'UTF-8');
            }

            // If the image doesn't exist in either folder, use a default image
            if (!file_exists($imagePath)) {
                $imagePath = '../images/default-package.png';
            }
            ?>
            <img src="<?= $imagePath ?>" alt="Package Image" class="device-image">
        </div>
        <div class="package-info">
            <h1><?= htmlspecialchars($package['name']); ?></h1>
            <div class="category">Category: <?= htmlspecialchars($package['category']); ?></div>

            <?php if (isset($package['star_rating'])): ?>
                <div class="rating">
                    <strong>Rating:</strong>
                    <?php for ($i = 0; $i < $package['star_rating']; $i++): ?>
                        <span class="star">★</span>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

            <p class="price">Price: $<?= htmlspecialchars(number_format($package['price'], 2)); ?></p>

            <!-- Display "Include Device" instead of "Quantity Sold" -->
            <div class="quantity-info">
                <p><strong>Include Device:</strong> <?= htmlspecialchars($package['device_include']); ?></p>
            </div>

            <div class="usage-info">
                <p><strong>Call Minutes:</strong> <?= htmlspecialchars($package['call_minutes'] ?? 0); ?> min</p>
                <p><strong>SMS Count:</strong> <?= htmlspecialchars($package['sms_count'] ?? 0); ?> SMS</p>
                <p><strong>Data Volume:</strong> <?= htmlspecialchars($package['data_volume'] ?? 0.00); ?> MB</p>

            </div>

            <div class="details"><strong>Description:</strong> <?= htmlspecialchars($package['description']); ?></div>

            <div class="cta-buttons">
                <a href="#">Customize</a>
                <!-- <a href="#">Add to Cart</a> -->
            </div>
            <form action="../customer/add_to_cart.php" method="POST">
                <input type="hidden" name="package_id" value="<?= htmlspecialchars($package['package_id']); ?>">
                <input type="hidden" name="package_name" value="<?= htmlspecialchars($package['name']); ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($package['price']); ?>">
                <input type="hidden" name="image" value="<?= htmlspecialchars($package['image']); ?>">
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
                    <img src="../image/user-icon.png" alt="User Icon">
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
            <p>No customer feedback available for this package.</p>
        <?php endif; ?>
    </div>
</body>

</html>