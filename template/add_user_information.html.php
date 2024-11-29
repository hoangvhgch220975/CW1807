<!-- add_user_information.html.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Information</title>
</head>
<style>
    /* Body styling */
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #a83232;
        /* Nền đỏ */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #333;
    }

    /* Form container */
    .form-container {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        padding: 30px 40px;
        width: 100%;
        max-width: 500px;
    }

    /* Logo */
    .logo {
        display: block;
        margin: 0 auto 20px auto;
        width: 120px;
        opacity: 0.8;
    }

    /* Heading */
    h2 {
        font-size: 24px;
        font-weight: bold;
        color: #a83232;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Labels */
    label {
        font-size: 14px;
        font-weight: 600;
        color: #555;
        display: block;
        margin-bottom: 8px;
    }

    /* Input fields */
    .input-field,
    .w-full {
        width: 100%;
        padding: 12px;
        border: 1px solid #dcdcdc;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 14px;
        color: #333;
        background-color: #fff;
        box-sizing: border-box;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    /* Focus effect for input fields */
    .input-field:focus,
    .w-full:focus {
        border-color: #e63946;
        box-shadow: 0 0 5px rgba(230, 57, 70, 0.5);
        outline: none;
    }

    /* Submit button */
    .submit-btn {
        background-color: #e63946;
        color: #fff;
        border: none;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        padding: 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
        width: 100%;
    }

    /* Hover effect for submit button */
    .submit-btn:hover {
        background-color: #d32f2f;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    /* Active state for submit button */
    .submit-btn:active {
        background-color: #b71c1c;
        transform: translateY(0);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Error message */
    .text-red-500 {
        color: #e63946;
        font-size: 14px;
        margin-bottom: 20px;
        text-align: center;
    }
</style>


<body>

    <main>
        <div class="form-container">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Add Information</h2>
            <?php if (isset($_GET['error'])): ?>
                <p class="text-red-500"><?= htmlspecialchars($_GET['error']) ?></p>
            <?php endif; ?>
            <form method="POST" action="../login/add_user_infomation.php" enctype="multipart/form-data">
                <img src="../image/logo.jpg" alt="Logo" class="logo">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Name</label>
                    <input type="text" name="fullname" class="input-field mt-1 block w-full p-3 rounded-lg focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Email</label>
                    <input type="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#25A6D9]" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Phone Number</label>
                    <input type="text" name="phone_number" class="input-field mt-1 block w-full p-3 rounded-lg focus:outline-none" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium">Address</label>
                    <input type="text" name="address" class="input-field mt-1 block w-full p-3 rounded-lg focus:outline-none" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium">Credit Card Number</label>
                    <input type="text" name="credit_card" class="input-field mt-1 block w-full p-3 rounded-lg focus:outline-none" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium">Upload Profile Picture</label>
                    <input type="file" name="profile_picture" accept="image/*" class="input-field mt-1 block w-full p-3 rounded-lg focus:outline-none" required>
                </div>
                <button type="submit" class="w-full submit-btn text-white py-3 rounded-lg focus:outline-none">Submit</button>
            </form>
        </div>
    </main>

</body>
<script>
    // Check for session messages
    <?php if (isset($_SESSION['error'])): ?>
        alert("<?= addslashes($_SESSION['error']); ?>");
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        alert("<?= addslashes($_SESSION['success']); ?>");
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
</script>

</html>