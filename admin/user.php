
<?php
try {
    include '../include/database.php';
    include '../include/databasefunction.php';
    $accounts = getAllUsers($pdo);
    $title = 'Manage Users';

    ob_start();
    include '../template_admin/user.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to connect to the database server';
    echo $e;
}
include "../template_admin/layout_admin.html.php";
?>
