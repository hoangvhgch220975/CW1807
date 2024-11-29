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
    include '../template/detail_device.html.php';
    $output = ob_get_clean();
    if ($isLoggedIn) {
        include '../template/layout_user.html.php';
    } else {
        include '../template/layout.html.php';
    }
    ?>

</body>

</html>