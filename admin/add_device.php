<?php
session_start();
include '../include/database.php';
include '../include/databasefunction.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data and sanitize inputs
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $category = trim($_POST['category']);
    $stock = trim($_POST['stock']);

    // Sanitize and validate image
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];
    $image_error = $image['error'];

    $upload_dir = '../upload/';  // Directory where images will be saved
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
    $image_new_name = uniqid('img_', true) . '.' . $image_extension; // Generate a unique image name

    // Validate image
    if ($image_error === 0) {
        if (!in_array($image_extension, $allowed_extensions)) {
            $error = "Invalid image format. Only JPG, JPEG, PNG, GIF are allowed.";
        } elseif ($image['size'] > 2000000) { // Limit image size to 2MB
            $error = "Image size is too large. Maximum allowed size is 2MB.";
        } else {
            // Move image to the target directory
            move_uploaded_file($image_tmp_name, $upload_dir . $image_new_name);
        }
    } else {
        $error = "Error uploading image.";
    }

    // Set sale count to 0 (assuming it's a new module)
    $sale_count = 0;

    if (empty($error)) {
        try {
            // Insert the new module into the database
            $stmt = $pdo->prepare('INSERT INTO devices (name, description, price, category, stock, image, sales_count) 
                                    VALUES (:name, :description, :price, :category, :stock, :image, :sale_count)');
            $stmt->execute([
                ':name' => $name,
                ':description' => $description,
                ':price' => $price,
                ':category' => $category,
                ':stock' => $stock,
                ':image' => $image_new_name,  // Save the new image file name
                ':sale_count' => $sale_count
            ]);

            // Redirect to the module management page with a success message
            header('Location: ../admin/add_device.php?message=Module added successfully.');
            exit();
        } catch (PDOException $e) {
            $error = 'Error adding module: ' . $e->getMessage();
        }
    }
}

// Render the add module form
$title = 'Add Device';
ob_start();
include '../template_admin/add_device.html.php';
$output = ob_get_clean();
include '../template_admin/layout_admin.html.php';
