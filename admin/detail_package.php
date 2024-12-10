<!-- detail_device.php -->
<html>

<head>
    <title>CheapDeal</title>
</head>

<body>
    <?php
    session_start(); // Start the session to access session variables
    $isLoggedIn = isset($_SESSION['account_id']); // Adjust this according to your session variable for logged-in users

    $title = 'CheapDeal.com';
    ob_start();
    include '../template_admin/detail_package.html.php';
    $output = ob_get_clean();
    include '../template_admin/layout_admin.html.php';
    ?>

</body>

</html>