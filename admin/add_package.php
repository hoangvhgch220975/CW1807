<?php
session_start();
include '../include/database.php'; // Kết nối cơ sở dữ liệu
include '../include/databasefunction.php'; // Các hàm trợ giúp

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy và vệ sinh các dữ liệu từ form
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    
    $service_include = trim($_POST['service_include']);
    $device_include = trim($_POST['device_include']);
    
    // Kiểm tra và xử lý ảnh
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];
    $image_error = $image['error'];
    
    $upload_dir = '../upload/';  // Thư mục lưu trữ ảnh
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
    $image_new_name = uniqid('img_', true) . '.' . $image_extension; // Tạo tên ảnh duy nhất

    // Kiểm tra và xử lý ảnh
    if ($image_error === 0 && !empty($image_name)) {
        if (!in_array($image_extension, $allowed_extensions)) {
            $error = "Invalid image format. Only JPG, JPEG, PNG, GIF are accepted.";
        } elseif ($image['size'] > 2000000) { // Giới hạn dung lượng ảnh 2MB
            $error = "Image size is too large. The maximum limit is 2MB.";
        } else {
            // Di chuyển ảnh vào thư mục
            move_uploaded_file($image_tmp_name, $upload_dir . $image_new_name);
        }
    } elseif ($image_error !== 0) {
        $error = "Error uploading the image.";
    }

    // Kiểm tra nếu không có lỗi thì thêm dữ liệu vào cơ sở dữ liệu
    if (empty($error)) {
        try {
            // Lấy thông tin từ bảng device (Lấy tất cả các thiết bị)
            $stmt_device = $pdo->prepare('SELECT device_id, price, name FROM devices WHERE name = :device_name');
            $stmt_device->execute([':device_name' => $device_include]);
            $device = $stmt_device->fetch();
            
            if ($device) {
                $device_id = $device['device_id'];
                $device_price = $device['price'];
                $device_name = $device['name'];
            } else {
                $error = "Device not found.";
            }

            // Lấy thông tin từ bảng service (Lấy tất cả các dịch vụ)
            $stmt_service = $pdo->prepare('SELECT service_id, price FROM service WHERE service_id = :service_id');
            $stmt_service->execute([':service_id' => $service_include]);
            $service = $stmt_service->fetch();
            
            if ($service) {
                $service_id = $service['service_id'];
                $service_price = $service['price'];
            } else {
                $error = "Service not found.";
            }

            if (empty($error)) {
                // Tính giá của gói: device_price + service_price + 10% tổng
                $total_price = $device_price + $service_price;
                $package_price = $total_price + ($total_price * 0.10);

                // Thêm dữ liệu vào bảng package (sự kết hợp giữa dịch vụ và thiết bị)
                $stmt_package = $pdo->prepare('INSERT INTO package (name, description, service_id, device_id, price, category, image, include_device, include_service)
                                            VALUES (:name, :description, :service_id, :device_id, :price, :category, :image, :include_device, :include_service)');
                $stmt_package->execute([
                    ':name' => $name,
                    ':description' => $description,
                    ':service_id' => $service_id,  // Dùng service_id từ form
                    ':device_id' => $device_id,   // Dùng device_id từ form
                    ':price' => $package_price,
                    ':category' => $category,
                    ':image' => $image_new_name, // Dùng ảnh đã upload
                    ':include_device' => $device_include, // Thiết bị bao gồm trong gói (tên thiết bị)
                    ':include_service' => $service_include, // Dịch vụ bao gồm trong gói
                ]);

                // Lấy ID của gói mới được thêm
                $package_id = $pdo->lastInsertId();

                // Lấy thông tin từ bảng service_detail để thêm vào package_detail
                $stmt_service_detail = $pdo->prepare('SELECT call_minutes, sms_count, data_volume FROM service_detail WHERE service_id = :service_id');
                $stmt_service_detail->execute([':service_id' => $service_id]);
                $service_detail = $stmt_service_detail->fetch();

                // Thêm chi tiết vào bảng package_detail
                $stmt_detail = $pdo->prepare('INSERT INTO package_detail (package_id, name, description, price, category, image, device_include, call_minutes, sms_count, data_volume)
                                            VALUES (:package_id, :name, :description, :price, :category, :image, :device_include, :call_minutes, :sms_count, :data_volume)');
                $stmt_detail->execute([
                    ':package_id' => $package_id,
                    ':name' => $name,
                    ':description' => $description,
                    ':price' => $package_price,
                    ':category' => $category,
                    ':image' => $image_new_name,
                    ':device_include' => $device_name,
                    ':call_minutes' => $service_detail['call_minutes'],
                    ':sms_count' => $service_detail['sms_count'],
                    ':data_volume' => $service_detail['data_volume'],
                ]);

                // Chuyển hướng về trang danh sách gói dịch vụ với thông báo thành công
                header('Location: ../admin/package.php?message=Package added successfully.');
                exit();
            }
        } catch (PDOException $e) {
            $error = 'Error adding package: ' . $e->getMessage();
        }
    }
}

// Render form
$title = 'Add Package';
ob_start();
include '../template_admin/add_package.html.php';
$output = ob_get_clean();
include '../template_admin/layout_admin.html.php';
?>
