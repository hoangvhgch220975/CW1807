<?php
session_start();
require_once '../include/database.php'; // Kết nối với database
require_once '../include/databasefunction.php'; // Các hàm hỗ trợ truy vấn database

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['account_id'])) {
    echo "<script>
            alert('You must log in to view your order history!');
            window.location.href = '../login/login.html.php';
          </script>";
    exit();
}

// Lấy ID của tài khoản từ session
$user_id = $_SESSION['account_id'];

try {
    // Truy vấn lấy lịch sử mua hàng từ bảng `orders`
    $stmt = $pdo->prepare("
        SELECT 
            o.order_id, 
            o.product_id, 
            o.product_type, 
            o.image, 
            o.name AS product_name, 
            o.quantity, 
            o.total_price, 
            o.order_date, 
            o.status
        FROM orders o
        WHERE o.user_id = :user_id
        ORDER BY o.order_date DESC
    ");
    $stmt->execute([':user_id' => $user_id]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lưu kết quả truy vấn
} catch (Exception $e) {
    die("Error fetching order history: " . $e->getMessage());
}

// Gửi dữ liệu qua giao diện
$title = 'Order History';
ob_start();
include '../template/order_history.html.php';
$output = ob_get_clean();
include '../template/layout_user.html.php';

?>