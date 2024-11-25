<?php
session_start();
include '../include/database.php';
include '../include/databasefunction.php';

try {
    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (isset($_SESSION['account_id'])) {
        $account_id = $_SESSION['account_id']; // Lấy account_id từ session
    } else {
        // Sử dụng JavaScript để hiển thị thông báo và chuyển hướng
        echo "<script>
                alert('You must log in to view your profile!');
                window.location.href = '../login/login.html.php';
              </script>";
        exit(); // Dừng thực thi mã PHP tiếp theo   
    }

    // Lấy thông tin người dùng từ cơ sở dữ liệu
    $infos = getUser($pdo, $account_id); // Truyền account_id vào hàm getUser
    if (!$infos) {
        throw new Exception("User information could not be retrieved.");
    }

    $title = 'User Information';

    // Bắt đầu output buffering
    ob_start();
    include '../template/profile_user.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = '<div class="error">Unable to retrieve the user information: ' . htmlspecialchars($e->getMessage()) . '</div>';
}

// Bao gồm layout
include "../template/layout_user.html.php";
