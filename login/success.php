<?php
session_start(); // Start the session to access session variables
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
        body {
            display: flex;
            flex-direction: column; /* Stack elements vertically */
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #a83232; /* Red background */
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h1 {
            font-size: 36px; /* Larger font size for success message */
            margin-bottom: 20px; /* Space below the heading */
        }
        p {
            font-size: 18px; /* Slightly smaller font size for the description */
        }
    </style>
</head>
<body>
    <h1>Success!</h1>
    <p>
        <?= htmlspecialchars($_SESSION['success'] ?? 'Your information has been updated successfully.') ?>
    </p>
    <script>
        // Redirect to the login page after 1.5 seconds
        setTimeout(function() {
            window.location.href = '../login/login.php'; // Change this to your actual login page URL
        }, 1500); // 1500 milliseconds = 1.5 seconds
    </script>
</body>
</html>

<?php
// Clear the success message from the session after displaying it
unset($_SESSION['success']);
?>