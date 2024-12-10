<?php
session_start();
include '../include/database.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra nếu có ID dịch vụ trong URL và đó là số hợp lệ
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $service_id = $_GET['id'];

    // Lấy thông tin dịch vụ từ cơ sở dữ liệu
    $stmt = $pdo->prepare('SELECT * FROM service WHERE service_id = :service_id');
    $stmt->execute([':service_id' => $service_id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);


    $stmt = $pdo->prepare('SELECT * FROM service_detail WHERE service_id = :service_id');
    $stmt->execute([':service_id' => $service_id]);
    $info = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra nếu dịch vụ tồn tại
    if (!$service) {
        $error = "Service not found.";
    }

    // Xử lý cập nhật dịch vụ khi có form submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy dữ liệu từ form và xử lý
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        $price = trim($_POST['price']);
        $stock = trim($_POST['stock']);
        $package_type = trim($_POST['package_type']);
        $call_minutes = trim($_POST['call_minutes']);
        $data_volume = trim($_POST['data_volume']);
        $message_count = trim($_POST['message_count']);
        $image = $_FILES['image'];
        
        // Validate and sanitize image if uploaded
        $image_file = $service['image']; // Retain old image if not updated
        if ($image['error'] === 0 && !empty($image['name'])) {
            $image_name = $image['name'];
            $image_tmp_name = $image['tmp_name'];
            $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (!in_array($image_extension, $allowed_extensions)) {
                $error = "Invalid image format.";
            } elseif ($image['size'] > 2000000) {
                $error = "Image size is too large.";
            } else {
                // Generate new name for image and move it to the upload folder
                $image_new_name = uniqid('img_', true) . '.' . $image_extension;
                move_uploaded_file($image_tmp_name, '../upload/' . $image_new_name);
                $image_file = $image_new_name;
            }
        }

        // Nếu không có lỗi, thực hiện cập nhật dịch vụ
        if (!isset($error)) {
            try {
                // Update service and service_detail tables
                $stmt_service = $pdo->prepare('UPDATE service 
                    SET name = :name, description = :description, price = :price, stock = :stock, package_type = :package_type, image = :image
                    WHERE service_id = :service_id');
                $stmt_service->execute([
                    ':service_id' => $service_id,
                    ':name' => $name,
                    ':description' => $description,
                    ':price' => $price,
                    ':stock' => $stock,
                    ':package_type' => $package_type,
                    ':image' => $image_file
                ]);

                // Update service_detail table
                $stmt_detail = $pdo->prepare('UPDATE service_detail 
                    SET call_minutes = :call_minutes, data_volume = :data_volume, message_count = :message_count, price = :price, stock = :stock, package_type = :package_type, image = :image
                    WHERE service_id = :service_id');
                $stmt_detail->execute([
                    ':service_id' => $service_id,
                    ':call_minutes' => $call_minutes,
                    ':data_volume' => $data_volume,
                    ':message_count' => $message_count,
                    ':price' => $price,
                    ':stock' => $stock,
                    ':package_type' => $package_type,
                    ':image' => $image_file

                ]);

                // Redirect to service list page with success message
                header('Location: ../admin/service.php?message=Service updated successfully.');
                exit();
            } catch (PDOException $e) {
                $error = 'Error updating service: ' . $e->getMessage();
            }
        }
    }
} else {
    $error = "Invalid service ID.";
}

// Render the edit service form
$title = 'Edit Service';
ob_start();
include '../template_admin/edit_service.html.php';
$output = ob_get_clean();
include '../template_admin/layout_admin.html.php';
?>
