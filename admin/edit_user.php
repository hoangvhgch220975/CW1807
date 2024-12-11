<?php
session_start();
include '../include/database.php';
include '../include/databasefunction.php';

// Kiểm tra nếu người dùng đã đăng nhập và có quyền admin
if (!isset($_SESSION['account_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $user_id = $_POST['account_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];  // Không mã hóa mật khẩu

    // Cập nhật thông tin người dùng trong bảng account
    $stmt = $pdo->prepare('UPDATE accounts SET username = :username, password = :password WHERE account_id = :id');
    $stmt->execute([
        ':id' => $user_id,
        ':username' => $username,
        ':password' => $password,  // Sử dụng mật khẩu trực tiếp mà không mã hóa
    ]);

    // Cập nhật thông tin người dùng trong bảng user_info (full_name)
    $full_name = $_POST['full_name'];
    $stmt = $pdo->prepare('UPDATE user_info SET full_name = :full_name WHERE account_id = :account_id');
    $stmt->execute([
        ':full_name' => $full_name,
        ':account_id' => $user_id
    ]);

    // Chuyển hướng lại trang danh sách người dùng sau khi cập nhật
    header('Location: user.php');
    exit();
} else {
    // Lấy thông tin người dùng để điền vào form
    $user_id = $_GET['id'];
    
    // Lấy thông tin từ bảng account
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE account_id = :id');
    $stmt->execute([':id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Nếu không tìm thấy người dùng trong bảng account
    if (!$user) {
        echo 'User not found!';
        exit();
    }

    // Lấy thông tin từ bảng user_info
    $stmt = $pdo->prepare('SELECT full_name FROM user_info WHERE account_id = :user_id');
    $stmt->execute([':user_id' => $user_id]);
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);

    // Nếu không tìm thấy thông tin người dùng trong bảng user_info
    if (!$user_info) {
        echo 'User info not found!';
        exit();
    }
}

include '../template_admin/edit_user.html.php';
?>
