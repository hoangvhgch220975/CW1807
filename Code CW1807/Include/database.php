<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'cw1807';

try {
    // Thiết lập kết nối PDO với chế độ lỗi là Exception và mã hóa UTF-8
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // Thiết lập chế độ báo lỗi là Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Nếu kết nối không thành công, xuất thông báo lỗi
    $output = 'Connection failed: ' . $e->getMessage();
}

// Hiển thị thông báo kết nối
if (isset($output)) {
    echo $output;
}
?>
