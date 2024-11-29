<html>
    <head>
        <title>CheapDeal</title>
    </head>
    <body>
        <?php

            $title ='CheapDeals.com';
            ob_start();
            include '../template_admin/admin.html.php';
            $output = ob_get_clean();
            include '../template_admin/layout_admin.html.php'; ?>
    </body>
</html>