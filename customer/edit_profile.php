<?php
session_start();
include '../include/database.php';
include '../include/databasefunction.php';

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['account_id'])) {
    echo "<script>
            alert('You must log in to edit your profile!');
            window.location.href = '../login/login.html.php';
          </script>";
    exit();
}

$account_id = $_SESSION['account_id'];
$message = "";

try {
    // Lấy thông tin người dùng
    $user_info = getUser($pdo, $account_id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Nhận dữ liệu từ form
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $credit_card_number = $_POST['credit_card_number'];

        // Kiểm tra xem người dùng có upload ảnh không
        $image = $user_info['image'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_name = uniqid() . "_" . basename($_FILES['image']['name']); // Thêm tiền tố để tránh trùng tên
            $target_file = "../image/profilepicture/" . $image_name;
        
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $image_name; // Cập nhật ảnh mới
            } else {
                throw new Exception("Failed to upload image. Please try again.");
            }
        }
        

        // Cập nhật thông tin vào cơ sở dữ liệu
        $stmt = $pdo->prepare("
            UPDATE user_info 
            SET full_name = :full_name, 
                email = :email, 
                phone_number = :phone_number, 
                address = :address, 
                credit_card_number = :credit_card_number,
                image = :image 
            WHERE account_id = :account_id
        ");
        $stmt->execute([
            ':full_name' => $full_name,
            ':email' => $email,
            ':phone_number' => $phone_number,
            ':address' => $address,
            ':credit_card_number' => $credit_card_number,
            ':image' => $image,
            ':account_id' => $account_id,
        ]);

        $message = "Profile updated successfully!";
        $user_info = getUser($pdo, $account_id); // Lấy lại thông tin cập nhật
    }
} catch (Exception $e) {
    $message = "An error occurred: " . htmlspecialchars($e->getMessage());
}

$title = 'Edit Information';
ob_start();
include '../template/edit_profile.html.php';
$output = ob_get_clean();
include '../template/layout_user.html.php';
?>
