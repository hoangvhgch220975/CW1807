<?php
session_start();
require '../include/databasefunction.php'; // Đưa vào hàm login

$error = ""; // Khởi tạo biến lỗi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = login($pdo, $username, $password); // Gọi hàm login từ databasefunction.php

    if ($user) {
        $_SESSION['account_id'] = $user['account_id']; // Lưu account_id vào session
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: index_admin.php");
        } elseif ($user['role'] == 'user') {
            header("Location: ../customer/index_user.php");
        }
        exit;
    } else {
        // Xác định lỗi
        $username_exists = checkUsernameExists($pdo, $username);
        if (!$username_exists) {
            $error = "Username does not exist!";
        } else {
            $error = "Invalid username or password!";
        }
    }
}

// Kiểm tra lỗi được truyền qua URL
if (isset($_GET['error'])) {
    $error = urldecode($_GET['error']);
}

include 'login.html.php'; // Đưa vào giao diện đăng nhập
