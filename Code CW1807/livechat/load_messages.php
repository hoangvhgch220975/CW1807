<?php
include 'config.php';

$stmt = $pdo->query("SELECT * FROM messages ORDER BY timestamp ASC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

$lastUser = null;

foreach ($messages as $message) {
    $username = htmlspecialchars($message['username']);
    $messageText = htmlspecialchars($message['message']);
    $time = date("H:i", strtotime($message['timestamp'])); // Chỉ hiển thị giờ và phút

    // Thay đổi vị trí dựa vào username
    $alignment = ($lastUser === $username) ? 'right' : 'left';
    $lastUser = $username;

    echo "<div class='message $alignment'>";
    echo "<strong>$username:</strong> $messageText";
    echo "<small>$time</small>";
    echo "</div>";
}
?>
