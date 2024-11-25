<?php
// databasefunction.php

// Bao gồm file database.php để có thể sử dụng biến $pdo
require_once 'database.php';

/**
 * Lấy tất cả các thiết bị từ bảng devices.
 *
 * @return array|false Trả về mảng thiết bị nếu thành công, hoặc false nếu thất bại.
 */
// Hàm lấy tất cả thiết bị (devices)
function getAllDevices()
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT * FROM devices");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Hàm lấy tất cả dịch vụ (services)
function getAllServices()
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT * FROM service");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Hàm lấy tất cả gói sản phẩm (packages)
function getAllPackages()
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT * FROM package");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function login($pdo, $username, $password)
{
    global $pdo;

    // Truy vấn để lấy thông tin tài khoản
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE username = ? AND password = ?');
    $stmt->execute([$username, $password]);
    return $stmt->fetch();
}

function checkUsernameExists($pdo, $username)
{
    $stmt = $pdo->prepare("SELECT 1 FROM accounts WHERE username = :username");
    $stmt->execute(['username' => $username]);
    return $stmt->rowCount() > 0;
}

function getUser($pdo, $account_id)
{
    try {
        $stmt = $pdo->prepare('SELECT * FROM user_info WHERE account_id = :account_id');
        $stmt->execute([':account_id' => $account_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception('Error fetching user details: ' . $e->getMessage());
    }
}


function registerUser($pdo, $username, $password, $role = 'user', $fullName, $email, $phoneNumber, $address, $creditCardNumber = null)
{
    try {
        // Bắt đầu giao dịch
        $pdo->beginTransaction();

        // Chèn dữ liệu vào bảng `accounts`
        $stmtAccount = $pdo->prepare("INSERT INTO accounts (username, password, role, created_at) 
                                    VALUES (:username, :password, :role, NOW())");
        $stmtAccount->bindParam(':username', $username);
        $stmtAccount->bindParam(':password', password_hash($password, PASSWORD_DEFAULT)); // Mã hóa mật khẩu
        $stmtAccount->bindParam(':role', $role);
        $stmtAccount->execute();

        // Lấy account_id vừa được chèn
        $accountId = $pdo->lastInsertId();

        // Chèn dữ liệu vào bảng `user_info`
        $stmtUserInfo = $pdo->prepare("INSERT INTO user_info (account_id, full_name, email, phone_number, address, credit_card_number, created_at) 
                                    VALUES (:account_id, :full_name, :email, :phone_number, :address, :credit_card_number, NOW())");
        $stmtUserInfo->bindParam(':account_id', $accountId);
        $stmtUserInfo->bindParam(':full_name', $fullName);
        $stmtUserInfo->bindParam(':email', $email);
        $stmtUserInfo->bindParam(':phone_number', $phoneNumber);
        $stmtUserInfo->bindParam(':address', $address);
        $stmtUserInfo->bindParam(':credit_card_number', $creditCardNumber);
        $stmtUserInfo->execute();

        // Commit giao dịch
        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        // Rollback nếu có lỗi
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
        return false;
    }
}
