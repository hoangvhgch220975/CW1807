<?php
session_start();
include '../include/database.php';
include '../include/databasefunction.php';

$error = '';
$success = '';

// Kiểm tra xem có phải là yêu cầu POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin từ form
    $user_id = $_POST['user_id'];
    $fullname = $_POST['full_name'];
    $gender = $_POST['gender'];
    $dateofbirth = $_POST['date_of_birth'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phone_number'];
    $address = $_POST['address'];
    $creditcard = $_POST['credit_card_number'];

    if (empty($fullname) || empty($email)) {
        $error = "Full Name and Email are required.";
    } else {
        // Update the user data
        $stmt = $pdo->prepare("UPDATE user_info SET full_name = ?, gender = ?, date_of_birth = ?, email = ?, phone_number = ?, address = ?, credit_card_number = ? WHERE user_id = ?");
        $success = $stmt->execute([$fullname, $gender, $dateofbirth, $email, $phonenumber, $address, $creditcard, $user_id]);
    }

    // Chuyển hướng về trang chỉnh sửa sau khi cập nhật
    if ($success) {
        header('Location: user.php?user_id=' . urlencode($user_id));
        exit();
    } else {
        $error = "There was an error updating the user information.";
    }
} else {
    // Kiểm tra xem có truyền user_id từ URL không
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        // Lấy thông tin người dùng
        $infos = getUserInfo($pdo, $user_id);
        if (!$infos || !is_array($infos)) {
            $error = "User not found.";
        }
    } else {
        $error = "No user ID provided.";
    }
}

// Render form chỉnh sửa
$title = 'Edit Information';
ob_start();
include '../template_admin/edit_detail_user.html.php';
$output = ob_get_clean();

// / Chèn thông báo vào trang dưới dạng window.alert()
if ($error) {
    echo "<script>alert('Error: $error');</script>";
} elseif ($success) {
    echo "<script>alert('Success: Information updated successfully!');</script>";
}
include '../template_admin/layout_admin.html.php';
