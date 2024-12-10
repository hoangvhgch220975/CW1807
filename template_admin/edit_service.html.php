<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* Align content to the top */
            height: 120vh;
            box-sizing: border-box;
            margin-top: 500px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            padding: 30px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            /* Ensure the form takes up most of the page */
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="file"] {
            padding: 5px;
        }

        /* Button Styling */
        button {
            padding: 12px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Error and Success Messages */
        .error {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
        }

        .success {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
        }

        /* Back Link Styling */
        a {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
                width: 90%;
                height: auto;
                /* Allow container to adjust height on smaller screens */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Service</h2>

        <!-- Error or Success Message -->
        <?php if (isset($error)): ?>
            <div class="error">
                <p><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['message'])): ?>
            <div class="success">
                <p><?= htmlspecialchars($_GET['message']) ?></p>
            </div>
        <?php endif; ?>

        <!-- Service Edit Form -->
        <form action="edit_service.php?id=<?= $service['service_id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Service Name</label>
                <input type="text" id="name" name="name" required value="<?= htmlspecialchars($service['name']) ?>">
            </div>

            <div class="form-group">
                <label for="description">Service Description</label>
                <textarea id="description" name="description" rows="4" required><?= htmlspecialchars($service['description']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price (in USD)</label>
                <input type="number" id="price" name="price" required value="<?= htmlspecialchars($service['price']) ?>" min="0" step="0.01">
            </div>

            <div class="form-group">
                <label for="stock">Stock Quantity</label>
                <input type="number" id="stock" name="stock" required value="<?= htmlspecialchars($service['stock']) ?>" min="0">
            </div>

            <div class="form-group">
                <label for="package_type">Package Type</label>
                <select id="package_type" name="package_type" required>
                    <option value="Call & Message" <?= $service['package_type'] == 'Call & Message' ? 'selected' : '' ?>>Call & Message</option>
                    <option value="Data & Message" <?= $service['package_type'] == 'Data & Message' ? 'selected' : '' ?>>Data & Message</option>
                    <option value="Call, Data & Message" <?= $service['package_type'] == 'Call, Data & Message' ? 'selected' : '' ?>>Call, Data & Message</option>
                    <option value="Call & Data" <?= $service['package_type'] == 'Call & Data' ? 'selected' : '' ?>>Call & Data</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Service Image</label>
                <input type="file" id="image" name="image" accept="image/*">
                <br>
                <label>Current Image:</label>
                <img src="../upload/<?= htmlspecialchars($service['image']) ?>" alt="Current Image" width="150">
            </div>

            <div class="form-group">
                <label for="call_minutes">Call Minutes</label>
                <input type="number" id="call_minutes" name="call_minutes" required value="<?= htmlspecialchars($info['call_minutes']) ?>">
            </div>

            <div class="form-group">
                <label for="data_volume">Data Volume (GB)</label>
                <input type="number" id="data_volume" name="data_volume" required value="<?= htmlspecialchars($info['data_volume']) ?>">
            </div>

            <div class="form-group">
                <label for="message_count">Message Count</label>
                <input type="number" id="message_count" name="message_count" required value="<?= htmlspecialchars($info['message_count']) ?>">
            </div>

            <div class="form-group">
                <button type="submit">Update Service</button>
            </div>
        </form>

        <!-- Back Link -->
        <a href="../admin/service.php">Back to Service List</a>
    </div>
</body>

</html>