<?php
// register.php
include '../include/database.php';
include '../include/databasefunction.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'user'; // Default role is 'user'

    // Check for duplicate usernames
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM accounts WHERE username = ?');
    $stmt->execute([$username]);
    if ($stmt->fetchColumn() > 0) {
        $error = "Username already exists! Please choose another one.";
        echo "<script>alert('" . addslashes($error) . "'); window.location.href='register.html.php';</script>";
        exit;
    }

    // Validate password
    if (!validatePassword($password)) {
        $error = "Password must be at least 8 characters, including uppercase, lowercase, numbers, and special characters.";
        echo "<script>alert('" . addslashes($error) . "'); window.location.href='register.html.php';</script>";
        exit;
    }

    // Register an account and get account_id
    $accountID = registerUser ($pdo, $username, $password, $role); // Use plain password

    if ($accountID) {
        $_SESSION['account_id'] = $accountID;

        // Add information to user_info table
        $sql = "INSERT INTO user_info (account_id) VALUES (:account_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':account_id' => $accountID]);

        $success = "Registration successful! Please complete your profile.";
        header('Location: ../template/add_user_information.html.php?success=' . urlencode($success));
    } else {
        $error = "Error during registration!";
        echo "<script>alert('" . addslashes($error) . "'); window.location.href='register.html.php';</script>";
    }
    exit; 
}
?>