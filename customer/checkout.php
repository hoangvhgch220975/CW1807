<html>
    <head>
        <title>CheapDeal</title>
    </head>
    <body>
        <?php

            $title ='Check Out';
            ob_start();
            include '../template/checkout.html.php';   
            $output = ob_get_clean();
            include '../template/layout_user.html.php'; ?>

        
    </body>
</html>