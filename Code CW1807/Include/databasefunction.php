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

function login($pdo,$username, $password)
{
    global $pdo;

    // Truy vấn để lấy thông tin tài khoản
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE username = ? AND password = ?');
    $stmt->execute([$username, $password]);
    return $stmt->fetch();
}
