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
            align-items: flex-start;
            /* Align content to the top */
            height: 120vh;
            box-sizing: border-box;
            margin-top: 400px;
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
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>



<body>
    <div class="container">
        <h2>Add a New Package</h2>

        <!-- Error/Sucess Messages -->
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <!-- Form for creating a package -->
        <form action="../admin/add_package.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Package Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="Phone">Phone</option>
                    <option value="Tablet">Tablet</option>
                    <option value="Router">Router</option>
                </select>
            </div>

            <!-- Service Include -->
            <div class="form-group">
                <label for="service_include">Service Include</label>
                <select id="service_include" name="service_include" required>
                    <?php foreach ($services as $service): ?>
                        <option value="<?= $service['service_id'] ?>"><?= htmlspecialchars($service['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Device Include -->
            <div class="form-group">
                <label for="device_include">Device Include</label>
                <select id="device_include" name="device_include" required>
                    <?php foreach ($devices as $device): ?>
                        <option value="<?= htmlspecialchars($device['device_id']) ?>"><?= htmlspecialchars($device['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>



            <div class="form-group">
                <label for="image">Package Image</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>

            <button type="submit">Add Package</button>
        </form>
    </div>
</body>

</html>