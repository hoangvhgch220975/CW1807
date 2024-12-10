<?php
session_start();
include '../include/database.php'; // Connect to the database
include '../include/databasefunction.php'; // Helper function to insert data

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from form and sanitize inputs
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $stock = trim($_POST['stock']);
    $package_type = trim($_POST['package_type']);
    
    // Get service detail information
    $call_minutes = trim($_POST['call_minutes']);
    $data_volume = trim($_POST['data_volume']);
    $message_count = trim($_POST['message_count']);
    
    // Check and process image
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];
    $image_error = $image['error'];
    
    $upload_dir = '../upload/';  // Directory to store images
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
    $image_new_name = uniqid('img_', true) . '.' . $image_extension; // Create unique image name

    // Check and process image
    if ($image_error === 0 && !empty($image_name)) {
        if (!in_array($image_extension, $allowed_extensions)) {
            $error = "Invalid image format. Only JPG, JPEG, PNG, GIF are accepted.";
        } elseif ($image['size'] > 2000000) { // Image size limit 2MB
            $error = "Image size is too large. The maximum limit is 2MB.";
        } else {
            // Move the image to the folder
            move_uploaded_file($image_tmp_name, $upload_dir . $image_new_name);
        }
    } elseif ($image_error !== 0) {
        $error = "Error uploading the image.";
    }

    // Check if there are no errors, then add data to the database
    if (empty($error)) {
        try {
            // Add data to the service table
            $stmt = $pdo->prepare('INSERT INTO service (name, description, price, stock, package_type, image)
                                VALUES (:name, :description, :price, :stock, :package_type, :image)');
            $stmt->execute([
                ':name' => $name,
                ':description' => $description,
                ':price' => $price,
                ':stock' => $stock,
                ':package_type' => $package_type, // Save the service package type
                ':image' => $image_new_name,  // Save the new image name
            ]);

            // Get the ID of the newly added service
            $service_id = $pdo->lastInsertId();

            // Add service details to the service_detail table
            $stmt_detail = $pdo->prepare('INSERT INTO service_detail (service_id, call_minutes, data_volume, message_count, price, stock, package_type, image)
                                        VALUES (:service_id, :call_minutes, :data_volume, :message_count, :price, :stock, :package_type, :image)');
            $stmt_detail->execute([
                ':service_id' => $service_id,
                ':call_minutes' => $call_minutes,
                ':data_volume' => $data_volume,
                ':message_count' => $message_count,
                ':price' => $price,
                ':stock' => $stock,
                ':package_type' => $package_type,
                ':image' => $image_new_name,

            ]);

            // Redirect to the service list page with success message
            header('Location: ../admin/service.php?message=Service added successfully.');
            exit();
        } catch (PDOException $e) {
            $error = 'Error adding service: ' . $e->getMessage();
        }
    }
}

// Render the form
$title = 'Add Service';
ob_start();
include '../template_admin/add_service.html.php';
$output = ob_get_clean();
include '../template_admin/layout_admin.html.php';
?>
