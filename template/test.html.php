<?php
session_start();
include '../include/database.php';
include '../include/databasefunction.php';

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

    // Kiểm tra thông tin bắt buộc
    if (empty($fullname) || empty($email)) {
        $error = "Full Name and Email are required.";
    } else {
        // Thực hiện cập nhật thông tin vào cơ sở dữ liệu
        $stmt = $pdo->prepare("UPDATE user_info SET full_name = ?, gender = ?, date_of_birth = ?, email = ?, phone_number = ?, address = ?, credit_card_number = ? WHERE user_id = ?");
        $success = $stmt->execute([$fullname, $gender, $dateofbirth, $email, $phonenumber, $address, $creditcard, $user_id]);

        if ($success) {
            $_SESSION['success'] = "User information updated successfully.";
            header("Location: ../admin/detail_user.php?user_id=$user_id");
            exit;
        } else {
            $error = "Failed to update user information.";
        }
    }
} else {
    // Lấy thông tin người dùng hiện tại khi form được hiển thị
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $infos = getUserInfo($pdo, $user_id);
        if (!$infos) {
            $error = "User not found.";
        }
    } else {
        $error = "User ID is missing.";
    }
}

// Render form chỉnh sửa
$title = 'Edit Information';
ob_start();
include '../template_admin/edit_detail_user.html.php';
$output = ob_get_clean();
include '../template_admin/layout_admin.html.php';


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    <link href="../styles.css" rel="stylesheet">
</head>

<body>
    <h1>Edit User Information</h1>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])) : ?>
        <p style="color: green;"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form action="edit_detail_user.php" method="POST">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id ?? '') ?>">

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name"
            value="<?= htmlspecialchars($infos['fullname'] ?? '') ?>" required><br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male" <?= (isset($infos['gender']) && $infos['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= (isset($infos['gender']) && $infos['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
            <option value="Other" <?= (isset($infos['gender']) && $infos['gender'] === 'Other') ? 'selected' : '' ?>>Other</option>
        </select><br><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth"
            value="<?= htmlspecialchars($infos['dateofbirth'] ?? '') ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"
            value="<?= htmlspecialchars($infos['email'] ?? '') ?>" required><br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number"
            value="<?= htmlspecialchars($infos['phonenumber'] ?? '') ?>" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address"
            value="<?= htmlspecialchars($infos['address'] ?? '') ?>" required><br><br>

        <label for="credit_card_number">Credit Card Number:</label>
        <input type="text" id="credit_card_number" name="credit_card_number"
            value="<?= htmlspecialchars($infos['creditcard'] ?? '') ?>" required><br><br>

        <button type="submit">Save Changes</button>
    </form>
</body>

</html>

function getUserInfo($pdo, $account_id)
{
    try {
        $stmt = $pdo->prepare('SELECT * FROM user_info WHERE user_id = :user_id');
        $stmt->execute([':user_id' => $account_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception('Error fetching user details: ' . $e->getMessage());
    }
}


tại sao nó đưa ra thông báo : Unable to retrieve the user information: No user ID provided.
nhưng khi tôi thoát ra trang chủ rồi vào lại detail_user, cấc thông tin vẫn được cập nhật và khi nhấn vào edit_detail_user, thông báo thành công lại hiện