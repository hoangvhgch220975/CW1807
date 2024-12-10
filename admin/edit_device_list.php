
<?php
try {
    include '../include/database.php';
    include '../include/databasefunction.php';
    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

    $devices = getAllDevices($searchQuery);
    $title = 'Edit Device List';

    ob_start();
    include '../template_admin/edit_device_list.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to connect to the database server';
    echo $e;
}
include "../template_admin/layout_admin.html.php";
?>
