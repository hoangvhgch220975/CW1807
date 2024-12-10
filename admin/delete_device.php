<?php
session_start();
include '../include/database.php';
include '../include/databasefunction.php';

if (isset($_GET['id'])) {
    // Lấy ID thiết bị từ URL
    $device_id = (int)$_GET['id'];

    try {
        // Kiểm tra xem thiết bị có tồn tại trong cơ sở dữ liệu không
        $stmt = $pdo->prepare('SELECT image FROM devices WHERE device_id = :device_id');
        $stmt->execute([':device_id' => $device_id]);
        $device = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($device) {
            // Lấy tên ảnh của thiết bị
            $image = $device['image'];
            $upload_dir = '../upload/'; // Đường dẫn lưu ảnh

            // Xóa ảnh nếu thiết bị có ảnh
            if ($image && file_exists($upload_dir . $image)) {
                unlink($upload_dir . $image); // Xóa ảnh
            }

            // Xóa thiết bị khỏi cơ sở dữ liệu
            $stmt = $pdo->prepare('DELETE FROM devices WHERE device_id = :device_id');
            $stmt->execute([':device_id' => $device_id]);

            // Chuyển hướng về trang quản lý thiết bị với thông báo thành công
            header('Location: ../admin/delete_device_list.php?message=Device deleted successfully.');
            exit();
        } else {
            // Nếu không tìm thấy thiết bị, hiển thị thông báo lỗi
            header('Location: ../admin/delete_device_list.php?error=Device not found.');
            exit();
        }
    } catch (PDOException $e) {
        // Nếu có lỗi trong quá trình thực hiện, hiển thị thông báo lỗi
        header('Location: ../admin/delete_device_list.php?error=Error deleting device: ' . $e->getMessage());
        exit();
    }
} else {
    // Nếu không có ID thiết bị trong URL, hiển thị thông báo lỗi
    header('Location: ../admin/delete_device_list.php?error=Device ID not specified.');
    exit();
}
?>
