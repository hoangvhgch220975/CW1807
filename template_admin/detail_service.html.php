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
    </style>
</head>

<body>
    <div class="service-details-container">
        <div class="service-image">
            <img src="../image/serviceimage/<?= htmlspecialchars($service['image']); ?>" alt="<?= htmlspecialchars($service['name']); ?>">
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
        </div>
    </div>
</body>

</html>