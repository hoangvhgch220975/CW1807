<!-- search.php -->
<html>

<head>
    <title>CheapDeal</title>
</head>

<body>
    <?php

    $title = 'CheapDeal.com';
    ob_start();
    include 'template/search_nonlog.html.php';
    $output = ob_get_clean();
    include 'template/layout.html.php';
    
    ?>


</body>

</html>