<?php
session_start();
include '../include/database.php';
include '../include/databasefunction.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data and sanitize inputs
    $device_id = trim($_POST['device_id']);  // Lấy ID thiết bị cần sửa
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

    // Initialize error flag
    $error = null;

    // Default image file (retain old image if no new image is uploaded)
    $image_file = null;

    if (!empty($image_name)) {
        // If new image is uploaded, process the upload
        $image_new_name = uniqid('img_', true) . '.' . $image_extension; // Generate a unique image name

        if ($image_error === 0) {
            if (!in_array($image_extension, $allowed_extensions)) {
                $error = "Invalid image format. Only JPG, JPEG, PNG, GIF are allowed.";
            } elseif ($image['size'] > 2000000) { // Limit image size to 2MB
                $error = "Image size is too large. Maximum allowed size is 2MB.";
            } else {
                // Move image to the target directory
                move_uploaded_file($image_tmp_name, $upload_dir . $image_new_name);
                $image_file = $image_new_name; // Save the new image name
            }
        } else {
            $error = "Error uploading image.";
        }
    } else {
        // If no new image is uploaded, retain the current image name
        $stmt = $pdo->prepare('SELECT image FROM devices WHERE device_id = :device_id');
        $stmt->execute([':device_id' => $device_id]);
        $device = $stmt->fetch(PDO::FETCH_ASSOC);
        $image_file = $device['image'];  // Retain the old image file if no new image uploaded
    }

    if (empty($error)) {
        try {
            // Update the device in the database
            $stmt = $pdo->prepare('UPDATE devices 
                                SET name = :name, description = :description, price = :price, 
                                    category = :category, stock = :stock, image = :image
                                WHERE device_id = :device_id');
            $stmt->execute([
                ':device_id' => $device_id,
                ':name' => $name,
                ':description' => $description,
                ':price' => $price,
                ':category' => $category,
                ':stock' => $stock,
                ':image' => $image_file  // Save the new image or retain the old one
            ]);

            // Redirect to the module management page with a success message
            header('Location: ../admin/edit_device.php?message=Device updated successfully.');
            exit();
        } catch (PDOException $e) {
            $error = 'Error updating device: ' . $e->getMessage();
        }
    }
}

// Get device details to prefill the form
$device_id = isset($_GET['id']) ? $_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT * FROM devices WHERE device_id = :id');
$stmt->execute([':id' => $device_id]);
$device = $stmt->fetch(PDO::FETCH_ASSOC);

// Render the edit device form
$title = 'Edit Device';
ob_start();
include '../template_admin/edit_device.html.php';
$output = ob_get_clean();
include '../template_admin/layout_admin.html.php';
?>
