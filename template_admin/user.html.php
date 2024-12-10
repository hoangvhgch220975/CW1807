<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../style.css" rel="stylesheet">
    <style>
        /* Custom styles for the table and actions */
        h2 {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 2;
            /* Đảm bảo tiêu đề luôn nằm trên bảng */
            padding: 20px;
            text-align: center;
        }

        /* Đặt bảng trong một vùng cuộn */
        .table-container {
            max-height: 400px;
            /* Giới hạn chiều cao của bảng */
            overflow-y: auto;
            /* Cho phép cuộn dọc */
            margin-top: 20px;
            border: 1px solid #E2E8F0;
            /* Thêm viền cho bảng */
            border-radius: 8px;
        }

        .table-header {
            position: sticky;
            top: 0;
            z-index: 1;
            background-color: #2D3748;
            /* Cool Gray */
            color: white;
        }

        .table-row:hover {
            background-color: #F7FAFC;
            /* Light Gray */
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .action-btn svg {
            margin-right: 0.5rem;
        }

        /* Button effects */
        .btn-primary {
            background-color: #4299E1;
            border-color: #4299E1;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            /* Adjust button text size */
        }

        .btn-primary:hover {
            background-color: #3182CE;
            transform: scale(1.05);
            transition: all 0.2s ease-in-out;
        }

        .btn-secondary {
            background-color: #48BB78;
            border-color: #48BB78;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            /* Adjust button text size */
        }

        .btn-secondary:hover {
            background-color: #38A169;
            transform: scale(1.05);
            transition: all 0.2s ease-in-out;
        }

        .btn-danger {
            background-color: #F56565;
            border-color: #F56565;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            /* Adjust button text size */
        }

        .btn-danger:hover {
            background-color: #E53E3E;
            transform: scale(1.05);
            transition: all 0.2s ease-in-out;
        }

        /* Custom styles for user profile image */
        .user-image {
            width: 50px;
            /* Increase image size */
            height: 50px;
            /* Increase image size */
            object-fit: cover;
            border-radius: 50%;
        }

        /* Ensure the body takes the full height of the screen without overflow */
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-x: hidden;
        }

        /* This div will stay centered and have overflow hidden */
        .content-container {
            overflow-x: auto;
            flex-grow: 1;
            padding: 2rem;
            background-color: #F7FAFC;
            /* Light gray background */
        }

        /* Adjust font size for table rows */
        .table-row td {
            font-size: 1.125rem;
            /* Increase font size for table content */
            padding: 1rem;
            /* Add padding to make cells larger */
        }

        /* Adjust font size for the table headers */
        .table-header th {
            font-size: 1.125rem;
            /* Increase font size for table headers */
            padding: 1rem;
            /* Add padding to make cells larger */
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900">

    <div class="content-container max-w-6xl mx-auto bg-white text-gray-900 p-8 rounded-lg shadow-xl">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">User Management</h2>

        <!-- Display the success or error message if it exists -->
        <?php if (isset($_GET['message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 shadow-lg">
                <?= htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <!-- Table container for scrollable rows -->
        <div class="table-container">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <thead class="table-header">
                    <tr>
                        <th class="text-left">ID</th>
                        <th class="text-left">Image</th>
                        <th class="text-left">FullName</th>
                        <th class="text-left">Username</th>
                        <th class="text-left">Role</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach ($accounts as $account): ?>
                        <tr class="table-row">
                            <td class="border-b border-gray-200 text-center"><?= htmlspecialchars($account['account_id'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="border-b border-gray-200 text-center">
                                <img src="<?= !empty($account['user_image']) ? '../image/profilepicture/' . htmlspecialchars($account['user_image'], ENT_QUOTES, 'UTF-8') : 'default-avatar.png' ?>" alt="User Image" class="user-image">
                            </td>
                            <td class="border-b border-gray-200"><?= htmlspecialchars($account['full_name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="border-b border-gray-200"><?= htmlspecialchars($account['username'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="border-b border-gray-200"><?= htmlspecialchars($account['role'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="border-b border-gray-200 text-center">
                                <a href="../admin/detail_user.php?id=<?= htmlspecialchars($account['account_id'], ENT_QUOTES, 'UTF-8') ?>" class="btn-secondary py-1 px-4 rounded-lg text-sm inline-block mb-2 shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18" />
                                    </svg>
                                    Detail
                                </a>
                                <a href="../admin/edit_user.php?id=<?= htmlspecialchars($account['account_id'], ENT_QUOTES, 'UTF-8') ?>" class="btn-primary py-1 px-4 rounded-lg text-sm inline-block mb-2 shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m4 4H9m0-8h4M5 6h14v14H5z" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="../admin/delete_user.php" method="post" class="inline">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($account['account_id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <button type="submit" class="btn-danger py-1 px-4 rounded-lg text-sm inline-block shadow-md action-btn" onclick="return confirm('Are you sure you want to delete this user?');">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>