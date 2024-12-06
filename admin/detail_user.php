<?php
session_start();
include '../include/database.php';
include '../include/databasefunction.php';

try {
    // Get the user ID from the query string
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];
    } else {
        throw new Exception("No user ID provided.");
    }

    // Fetch user information based on the provided ID
    
    $users = getUser($pdo, $user_id);

    if (!$users) {
        throw new Exception("User not found.");
    }

    $title = 'User Information';

    ob_start();
    include '../template_admin/detail_user.html.php';
    $output = ob_get_clean();
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Unable to retrieve the user information: ' . $e->getMessage();
}

include "../template_admin/layout_admin.html.php";
