<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    <link href="../styles.css" rel="stylesheet">
</head>

<body>
    <h1>Edit User Information</h1>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])) : ?>
        <p style="color: green;"><?= htmlspecialchars($_SESSION['success']) ?></p>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form action="edit_detail_user.php" method="POST">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id ?? '') ?>">

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name"
            value="<?= htmlspecialchars($infos['fullname'] ?? '') ?>" required><br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male" <?= (isset($infos['gender']) && $infos['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= (isset($infos['gender']) && $infos['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
            <option value="Other" <?= (isset($infos['gender']) && $infos['gender'] === 'Other') ? 'selected' : '' ?>>Other</option>
        </select><br><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth"
            value="<?= htmlspecialchars($infos['dateofbirth'] ?? '') ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"
            value="<?= htmlspecialchars($infos['email'] ?? '') ?>" required><br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number"
            value="<?= htmlspecialchars($infos['phonenumber'] ?? '') ?>" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address"
            value="<?= htmlspecialchars($infos['address'] ?? '') ?>" required><br><br>

        <label for="credit_card_number">Credit Card Number:</label>
        <input type="text" id="credit_card_number" name="credit_card_number"
            value="<?= htmlspecialchars($infos['creditcard'] ?? '') ?>" required><br><br>

        <button type="submit">Save Changes</button>
    </form>
</body>

</html>
