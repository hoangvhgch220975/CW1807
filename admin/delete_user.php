<?php
session_start();
include '../include/database.php';
include '../include/databasefunction.php';

// Ensure the request method is POST and the user ID is provided
if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['id'])) {
    // Redirect to the user management page if the request is not valid
    header('Location: user.php');
    exit();
}

$user_id = $_POST['id'];

try {
    // Prepare the DELETE statement
    $stmt = $pdo->prepare('DELETE FROM accounts WHERE account_id = :id');
    $stmt->execute([':id' => $user_id]);

    if ($stmt->rowCount() > 0) {
        // If a row was deleted, set a success message
        $message = "User deleted successfully.";
    } else {
        // If no row was deleted, set an error message
        $message = "User not found or could not be deleted.";
    }
} catch (PDOException $e) {
    $message = "Error deleting user: " . $e->getMessage();
}

// Redirect back to the user management page with a success or error message
header('Location: user.php?message=' . urlencode($message));
exit();
