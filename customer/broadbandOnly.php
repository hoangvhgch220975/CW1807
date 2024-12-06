
<?php
try {
    include '../include/database.php';
    include '../include/databasefunction.php';
    $title = 'CheapDeal.com';

    ob_start();
    include 'D:\CODE\CO1201\HTML\Web1\htdocs\Code on Class\Code CW1807\template\broadbandOnly_user.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Unable to connect to the database server';
    echo $e;
}
include "../template/layout_user.html.php";
?>
