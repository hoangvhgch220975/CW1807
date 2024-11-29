<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);
            margin: 0;
            padding: 0;
            color: #343a40;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin-top: 5%;
        }

        .profile-form {
            background: #ffffff;
            width: 90%;
            max-width: 600px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
            margin-left: 32.5%;
            margin: 200px auto;
        }

        .profile-form h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-form .form-group {
            margin-bottom: 15px;
        }

        .profile-form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-form input[type="text"],
        .profile-form input[type="email"],
        .profile-form input[type="file"],
        .profile-form input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .profile-form .form-group img {
            display: block;
            margin: 10px auto;
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .profile-form .form-actions {
            text-align: center;
        }

        .profile-form button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .profile-form button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="profile-form">
        <h1>Edit Profile</h1>
        <?php if (!empty($message)): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($user_info['full_name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user_info['email']) ?>" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" value="<?= htmlspecialchars($user_info['phone_number']) ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?= htmlspecialchars($user_info['address']) ?>" required>
            </div>
            <div class="form-group">
                <label for="credit_card_number">Credit Card Number:</label>
                <input type="number" id="credit_card_number" name="credit_card_number" value="<?= htmlspecialchars($user_info['credit_card_number']) ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Profile Picture:</label>
                <img src="../image/profilepicture/<?= htmlspecialchars($user_info['image']) ?>" alt="Profile Picture">
                <input type="file" id="image" name="image">
            </div>
            <div class="form-actions" >
                <button type="submit" style="background-color: red;">Save Changes</button>
            </div>
        </form>
    </div>
</body>

</html>
