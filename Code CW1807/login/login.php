<?php
session_start();
require '../include/databasefunction.php'; // Đưa vào hàm login

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = login($pdo,$username, $password); // Gọi hàm login từ databasefunction.php

    if ($user) {
        // Đăng nhập thành công, lưu thông tin người dùng vào session
        $_SESSION['user_id'] = $user['account_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Kiểm tra vai trò của người dùng và chuyển hướng
        if ($user['role'] == 'admin') {
            header("Location: index_admin.php"); // Trang cho admin
        } elseif ($user['role'] == 'user') {
            header("Location: ../index.php"); // Trang cho user
        } else {
            header("Location: index.php"); // Chuyển hướng mặc định nếu role không xác định
        }
        exit();
    } else {
        // Đăng nhập thất bại, hiển thị thông báo lỗi
        $error = "Username or password is incorrect.";
    }
}
include 'login.html.php'; // Đưa vào giao diện đăng nhập
?>
