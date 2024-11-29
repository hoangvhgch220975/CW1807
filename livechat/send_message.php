<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $message = htmlspecialchars($_POST['message']);

    $stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (:username, :message)");
    $stmt->execute(['username' => $username, 'message' => $message]);
}
?>
