<?php
// add_user_information.php
// Kết nối tới database
include '../include/database.php';
include '../include/databasefunction.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy account_id từ session
    $accountID = $_SESSION['account_id'] ?? null;

    if (!$accountID) {
        die("Error: User ID is not set in the session.");
    }

    // Lấy dữ liệu từ form
    $fullName = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $phoneNumber = $_POST['phone_number'] ?? '';
    $address = $_POST['address'] ?? '';
    $creditCard = $_POST['credit_card'] ?? '';
    $image = $_FILES['profile_picture'] ?? null;

    // Kiểm tra nếu dữ liệu đã tồn tại
    $sqlFetch = "SELECT full_name, email, phone_number, address, credit_card_number, image FROM user_info WHERE account_id = :account_id";
    $stmtFetch = $pdo->prepare($sqlFetch);
    $stmtFetch->execute([':account_id' => $accountID]);
    $existingData = $stmtFetch->fetch(PDO::FETCH_ASSOC);

    if (!$existingData) {
        die("Error: User not found in the database.");
    }

    // Debugging: Ghi log dữ liệu hiện tại
    error_log("Existing Data: " . print_r($existingData, true));

    // Kiểm tra nếu không có thay đổi nào
    if (
        $existingData['full_name'] === $fullName &&
        $existingData['email'] === $email &&
        $existingData['phone_number'] === $phoneNumber &&
        $existingData['address'] === $address &&
        $existingData['credit_card_number'] === $creditCard
    ) {
        $_SESSION['error'] = "No changes were detected. Please update the information before submitting.";
        header('Location: ../template/add_user_information.html.php');
        exit;
    }

    // Xử lý ảnh nếu có tải lên
    $imagePath = $existingData['image']; // Giữ ảnh cũ nếu không tải lên mới
    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        $targetDir = '../upload/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($fileType, $allowedTypes)) {
            $_SESSION['error'] = "Invalid image type. Allowed types: JPG, JPEG, PNG, GIF.";
            header('Location: ../template/add_user_information.html.php');
            exit;
        }

        $newImageName = uniqid() . '.' . $fileType;
        $targetFile = $targetDir . $newImageName;

        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            $imagePath = $newImageName;
        } else {
            $_SESSION['error'] = "Failed to upload image.";
            header('Location: ../template/add_user_information.html.php');
            exit;
        }
    }

    // Cập nhật thông tin vào bảng user_info
    $sqlUpdate = "UPDATE user_info 
                SET full_name = :full_name, 
                    email = :email, 
                    phone_number = :phone_number, 
                    address = :address, 
                    credit_card_number = :credit_card_number, 
                    image = :image 
                WHERE account_id = :account_id";

    $stmtUpdate = $pdo->prepare($sqlUpdate);
    if ($stmtUpdate->execute([
        ':full_name' => $fullName,
        ':email' => $email,
        ':phone_number' => $phoneNumber,
        ':address' => $address,
        ':credit_card_number' => $creditCard,
        ':image' => $imagePath,
        ':account_id' => $accountID
    ])) {
        if ($stmtUpdate->rowCount()) {
            $_SESSION['success'] = "Information updated successfully!";
            header('Location: ../login/success.php');
            exit;
        } else {
            $_SESSION['error'] = "No changes were detected. Please update the information before submitting.";
            header('Location: ../template/add_user_information.html.php');
            exit;
        }
    } else {
        // Get SQL error info
        $errorinfo = $stmtUpdate->errorInfo();
        $_SESSION['error'] = "Error updating information: " . $errorinfo[2];
        header('Location: ../template/add_user_information.html.php');
    }
    exit;
}
?>