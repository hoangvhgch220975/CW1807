<?php
session_start();
include '../include/database.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra xem có ID dịch vụ cần xóa không
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $service_id = $_GET['id'];

    try {
        // Bắt đầu transaction để đảm bảo tính toàn vẹn của dữ liệu
        $pdo->beginTransaction();

        // Xóa chi tiết dịch vụ trong bảng service_detail trước (vì bảng này có ràng buộc khóa ngoại với bảng service)
        $stmt_detail = $pdo->prepare('DELETE FROM service_detail WHERE service_id = :service_id');
        $stmt_detail->execute([':service_id' => $service_id]);

        // Xóa dịch vụ trong bảng service
        $stmt_service = $pdo->prepare('DELETE FROM service WHERE service_id = :service_id');
        $stmt_service->execute([':service_id' => $service_id]);

        // Commit transaction nếu không có lỗi
        $pdo->commit();

        // Chuyển hướng về trang danh sách dịch vụ với thông báo thành công
        header('Location: ../admin/service.php?message=Service deleted successfully.');
        exit();
    } catch (PDOException $e) {
        // Nếu có lỗi, rollback transaction và hiển thị thông báo lỗi
        $pdo->rollBack();
        $error = 'Error deleting service: ' . $e->getMessage();
    }
} else {
    // Nếu không có ID dịch vụ hoặc ID không hợp lệ
    $error = 'Invalid service ID.';
}

// Render thông báo lỗi nếu có
if (isset($error)) {
    echo '<div class="error">' . htmlspecialchars($error) . '</div>';
}
?>
