<html>
    <head>
        <title>CheapDeal</title>
    </head>
    <body>
        <?php

            $title ='Process Payment';
            ob_start();
            include '../template/make_payment.html.php';   
            $output = ob_get_clean();
            include '../template/layout_user.html.php'; ?>

        
    </body>
</html>