<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        /* General Layout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align content to the top */
            height: 120vh;
            box-sizing: border-box;
            margin-top: 250px;
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
            height: 100%; /* Ensure the form takes up most of the page */
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
                height: auto; /* Allow container to adjust height on smaller screens */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Device</h2>

        <?php if (isset($error)): ?>
            <div class="error">
                <p style="color:red;"><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['message'])): ?>
            <div class="success">
                <p style="color:green;"><?= htmlspecialchars($_GET['message']) ?></p>
            </div>
        <?php endif; ?>

        <form action="../admin/edit_device.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="device_id" value="<?= $device['device_id'] ?>">

            <div class="form-group">
                <label for="name">Device Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter device name" value="<?= isset($device['name']) ? htmlspecialchars($device['name']) : '' ?>">
            </div>

            <div class="form-group">
                <label for="description">Device Description</label>
                <textarea id="description" name="description" rows="4" required placeholder="Enter device description"><?= isset($device['description']) ? htmlspecialchars($device['description']) : '' ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" required placeholder="Enter price" value="<?= isset($device['price']) ? htmlspecialchars($device['price']) : '' ?>" min="0" step="0.01">
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select category</option>
                    <option value="phone" <?= isset($device['category']) && $device['category'] == 'phone' ? 'selected' : '' ?>>Phone</option>
                    <option value="tablet" <?= isset($device['category']) && $device['category'] == 'tablet' ? 'selected' : '' ?>>Tablet</option>
                    <option value="router" <?= isset($device['category']) && $device['category'] == 'router' ? 'selected' : '' ?>>Router</option>
                </select>
            </div>

            <div class="form-group">
                <label for="stock">Stock Quantity</label>
                <input type="number" id="stock" name="stock" required placeholder="Enter stock quantity" value="<?= isset($device['stock']) ? htmlspecialchars($device['stock']) : '' ?>" min="0">
            </div>

            <div class="form-group">
                <label for="image">Device Image</label>
                <input type="file" id="image" name="image" accept="image/*">
                <?php if (!empty($device['image'])): ?>
                    <div>
                        <img src="../upload/<?= htmlspecialchars($device['image']) ?>" alt="Current Image" width="100">
                    </div>
                    <p>Leave empty to keep current image.</p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <button type="submit">Update Device</button>
            </div>
        </form>

        <a href="../admin/device.php">Back to Device List</a>
    </div>
</body>

</html>
