<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        /* Tổng quan */
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

        /* Container */
        .profile {
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

        /* Tiêu đề */
        h1 {
            text-align: center;
            color: #495057;
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }

        /* Profile Information */
        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-item label {
            font-weight: bold;
            font-size: 16px;
            color: #212529;
            flex: 1;
        }

        .info-item span {
            font-size: 16px;
            color: #6c757d;
            flex: 2;
            text-align: right;
            word-wrap: break-word;
        }

        /* Hover Effect for Items */
        .info-item:hover {
            background-color: #f8f9fa;
            transition: background-color 0.3s ease-in-out;
        }

        /* Nút hành động */
        .actions {
            margin-top: 20px;
            text-align: center;
        }

        .actions a {
            text-decoration: none;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .actions a:hover {
            background-color: #0056b3;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile {
                padding: 20px;
            }

            .info-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-item span {
                text-align: left;
                margin-top: 5px;
            }
        }

        /* Keyframe Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<div class="profile">
    <h1>User Profile</h1>
    <div class="profile-picture" style="text-align: center; margin-bottom: 20px;">
        <img src="../image/<?= htmlspecialchars($infos['image']) ?>" alt="User Profile Picture"
            style="border-radius: 50%; width: 150px; height: 150px; object-fit: cover; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    </div>
    <div class="profile-info">
        <div class="info-item">
            <label>Full Name:</label>
            <span><?= htmlspecialchars($infos['full_name']) ?></span>
        </div>
        <div class="info-item">
            <label>Email:</label>
            <span><?= htmlspecialchars($infos['email']) ?></span>
        </div>
        <div class="info-item">
            <label>Phone Number:</label>
            <span><?= htmlspecialchars($infos['phone_number']) ?></span>
        </div>
        <div class="info-item">
            <label>Address:</label>
            <span><?= htmlspecialchars($infos['address']) ?></span>
        </div>
        <div class="info-item">
            <label>Credit Card Number:</label>
            <span><?= htmlspecialchars($infos['credit_card_number']) ?></span>
        </div>
    </div>
    <div class="actions">
        <a href="../customer/edit_profile.php" style="background-color: red">Edit Profile</a>
    </div>
</div>


</html>