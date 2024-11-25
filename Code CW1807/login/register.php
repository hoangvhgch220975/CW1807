<?php
require_once '../include/database.php';             
require_once '../include/databasefunction.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone_number'];
    $address = $_POST['address'];
    $creditCardNumber = $_POST['credit_card_number'] ?? null;

    // Kiểm tra username có tồn tại không
    if (checkUsernameExists($pdo, $username)) {
        echo "Username is already exists!";
    } else {
        $result = registerUser($pdo, $username, $password, 'user', $fullName, $email, $phoneNumber, $address, $creditCardNumber);

        if ($result) {
            echo "User registered successfully!";
        } else {
            echo "Error while registering user!";
        }
    }
}
include 'register.html.php';
?>

