<!-- detail_service.php -->
<html>

<head>
    <title>CheapDeal</title>
</head>

<body>
    <?php

    $title = 'CheapDeal.com';
    ob_start();
    include '../template/detail_service.html.php';
    $output = ob_get_clean();
    include '../template/layout_user.html.php';
    ?>

</body>

</html>