<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    body {
        margin: 0;
        display: flex;
        justify-content: center;
        /* Căn giữa theo chiều ngang */
        align-items: center;
        /* Căn giữa theo chiều dọc */
        min-height: 100vh;
        /* Chiều cao tối thiểu bằng màn hình */
        background: linear-gradient(to right, #7F00FF, #E100FF);
        /* Gradient nền */
        font-family: Arial, sans-serif;
        margin-top: 200px;

    }

    .container {
        max-width: 800px;
        /* Chiều rộng tối đa */
        background-color: #1F2937;
        /* Màu nền của khung chứa */
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        color: white;
    }

    .profile-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #7F00FF;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
    }

    .info-section {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        color: #D1D5DB;
    }

    .info-section p {
        font-size: 1rem;
        line-height: 1.5;
    }

    .btn {
        background-color: #3B82F6;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: bold;
        text-align: center;
        transition: transform 0.2s, background-color 0.2s;
    }

    .btn:hover {
        background-color: #2563EB;
        transform: scale(1.05);
    }
</style>


<body class="bg-gradient-to-r from-purple-600 to-blue-500 text-gray-100 p-8 min-h-screen flex items-center justify-center">

    <div class="max-w-4xl mx-auto bg-gray-900 p-8 rounded-xl shadow-2xl">
        <h2 class="text-4xl font-bold text-white mb-4">User Information</h2>
        <p class="text-gray-400 mb-8">Check out the details below!</p>

        <!-- Display the success or error message if it exists -->
        <?php if (isset($_GET['message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                <?= htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <div class="flex space-x-8">
            <!-- Profile Image -->
            <div>
                <h3 class="text-xl font-semibold text-white mb-2">Profile Image</h3>
                <img src="../image/profilepicture/<?= htmlspecialchars($users['image'], ENT_QUOTES, 'UTF-8') ?>" alt="Profile Image"
                    class="w-48 h-48 object-cover rounded-full border-4 border-purple-500 shadow-lg">
            </div>

            <!-- Basic Info -->
            <div class="flex-1">
                <h3 class="text-xl font-semibold text-white mb-4">Basic Info</h3>
                <div class="space-y-2">
                    <p class="text-lg text-gray-300"><strong>Full Name:</strong> <?= htmlspecialchars($users['full_name'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p class="text-lg text-gray-300"><strong>Gender:</strong> <?= htmlspecialchars($users['gender'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p class="text-lg text-gray-300"><strong>Email:</strong> <?= htmlspecialchars($users['email'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p class="text-lg text-gray-300"><strong>Phone Number:</strong> <?= htmlspecialchars($users['phone_number'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p class="text-lg text-gray-300"><strong>Date of Birth:</strong> <?= htmlspecialchars($users['date_of_birth'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p class="text-lg text-gray-300"><strong>Address:</strong> <?= htmlspecialchars($users['address'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p class="text-lg text-gray-300"><strong>Credit Card Number:</strong> <?= htmlspecialchars($users['credit_card_number'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex space-x-4">
            <a href="../admin/edit_detail_user.php?user_id=<?= htmlspecialchars($users['user_id'], ENT_QUOTES, 'UTF-8') ?>"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">Edit</a>
        </div>
    </div>

</body>

</html>