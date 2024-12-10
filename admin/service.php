
<?php
try {
    include '../include/database.php';
    include '../include/databasefunction.php';
    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

    $services = getAllServices($searchQuery);
    $title = 'Manage Service';

    ob_start();
    include '../template_admin/service.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to connect to the database server';
    echo $e;
}
include "../template_admin/layout_admin.html.php";
?>
