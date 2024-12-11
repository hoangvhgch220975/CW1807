<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link href="../styles.css" rel="stylesheet"> -->
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Main Container -->
    <div class="max-w-3xl mx-auto my-12 p-8 bg-white rounded-lg shadow-xl">
        <h1 class="text-3xl font-bold text-center text-purple-600 mb-6">Edit User Information</h1>

        <!-- Error and Success messages -->
        <?php if (isset($error)) : ?>
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])) : ?>
            <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Form Start -->
        <form action="edit_detail_user.php" method="POST">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id ?? '') ?>">

            <!-- Full Name -->
            <div class="mb-4">
                <label for="full_name" class="block text-lg text-gray-700 font-semibold mb-2">Full Name</label>
                <input type="text" id="full_name" name="full_name"
                    value="<?= htmlspecialchars($infos['full_name'] ?? '') ?>"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <!-- Gender -->
            <div class="mb-4">
                <label for="gender" class="block text-lg text-gray-700 font-semibold mb-2">Gender</label>
                <select id="gender" name="gender"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                    required>
                    <option value="Male" <?= (isset($infos['gender']) && $infos['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= (isset($infos['gender']) && $infos['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= (isset($infos['gender']) && $infos['gender'] === 'Other') ? 'selected' : '' ?>>Other</option>
                    <option value="N/A" <?= (isset($infos['gender']) && empty($infos['gender'])) ? 'selected' : '' ?>>N/A</option> <!-- Default option if empty -->
                </select>
            </div>

            <!-- Date of Birth -->
            <div class="mb-4">
                <label for="date_of_birth" class="block text-lg text-gray-700 font-semibold mb-2">Date of Birth</label>
                <input type="date" id="date_of_birth" name="date_of_birth"
                    value="<?= htmlspecialchars($infos['date_of_birth'] ?? '') ?>"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-lg text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email"
                    value="<?= htmlspecialchars($infos['email'] ?? '') ?>"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <!-- Phone Number -->
            <div class="mb-4">
                <label for="phone_number" class="block text-lg text-gray-700 font-semibold mb-2">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number"
                    value="<?= htmlspecialchars($infos['phone_number'] ?? '') ?>"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label for="address" class="block text-lg text-gray-700 font-semibold mb-2">Address</label>
                <input type="text" id="address" name="address"
                    value="<?= htmlspecialchars($infos['address'] ?? '') ?>"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                    required>
            </div>

            <!-- Credit Card Number -->
            <div class="mb-4">
                <label for="credit_card_number" class="block text-lg text-gray-700 font-semibold mb-2">Credit Card Number</label>
                <input type="text" id="credit_card_number" name="credit_card_number"
                    value="<?= htmlspecialchars($infos['credit_card_number'] ?? '') ?>"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-600"
                    required>
            </div>


            <!-- Submit Button -->
            <div class="mb-4">
                <button type="submit"
                    class="w-full py-3 bg-purple-600 text-white font-semibold rounded-lg shadow-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

</body>

</html>