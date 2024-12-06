<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../style.css" rel="stylesheet">
    <style>
        /* Custom styles for the form */
        body {
            background-color: #f7fafc; /* Light background */
            color: #2d3748; /* Dark text */
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            background-color: white;
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 0.375rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: inline-block;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            font-size: 1rem;
            color: #4a5568;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 5px rgba(66, 153, 241, 0.5);
        }

        button[type="submit"] {
            background-color: #4299e1;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        button[type="submit"]:hover {
            background-color: #3182ce;
        }

        .text-center {
            text-align: center;
        }

        .message {
            background-color: #f0fdfa;
            color: #2b6cb0;
            padding: 1rem;
            border-radius: 0.375rem;
            border: 1px solid #bee3f8;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit User</h2>

    <!-- Success or error message -->
    <?php if (isset($_GET['message'])): ?>
        <div class="message"><?= htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <!-- Form to edit user data -->
    <form method="POST" action="edit_user.php">
        <input type="hidden" name="account_id" value="<?= htmlspecialchars($user['account_id'], ENT_QUOTES, 'UTF-8') ?>">

        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" id="full_name" value="<?= htmlspecialchars($user_info['full_name'], ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Password (leave blank if no change):</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="text-center">
            <button type="submit">Update User</button>
        </div>
    </form>
</div>

</body>
</html>
