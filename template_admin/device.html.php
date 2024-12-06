<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../style.css" rel="stylesheet">
    <style>
        /* Custom styles for the table and actions */
        .table-header {
            background-color: #2D3748;
            color: white;
        }

        .table-row:hover {
            background-color: #F7FAFC;
        }

        .action-btn-container {
            display: flex;
            gap: 10px;
            /* Adds space between buttons */
            justify-content: center;
            /* Centers the buttons horizontally */
        }

        .btn-primary,
        .btn-danger {
            padding: 0.5rem 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.375rem;
            transition: all 0.2s ease-in-out;
        }

        .btn-primary {
            background-color: #4299E1;
            border-color: #4299E1;
            color: white;
        }

        .btn-primary:hover {
            background-color: #3182CE;
            transform: scale(1.05);
        }

        .btn-danger {
            background-color: #F56565;
            border-color: #F56565;
            color: white;
        }

        .btn-danger:hover {
            background-color: #E53E3E;
            transform: scale(1.05);
        }

        .device-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900">

    <div class="content-container max-w-6xl mx-auto bg-white text-gray-900 p-8 rounded-lg shadow-xl">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>

        <!-- Display the success or error message if it exists -->
        <?php if (isset($_GET['message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 shadow-lg">
                <?= htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <!-- Search form -->
        <form method="get" class="mb-4">
            <div class="flex items-center space-x-4">
                <input type="text" name="search" placeholder="Search by device name" class="p-2 border rounded w-full" value="<?= htmlspecialchars($search ?? '', ENT_QUOTES, 'UTF-8') ?>" />
                <button type="submit" class="btn-primary px-4 py-2 rounded-lg">Search</button>
            </div>
        </form>

        <!-- Device Table -->
        <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
            <thead class="table-header">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold">Device ID</th>
                    <th class="py-3 px-4 text-left font-semibold">Image</th>
                    <th class="py-3 px-4 text-left font-semibold">Name</th>
                    <th class="py-3 px-4 text-left font-semibold">Description</th>
                    <th class="py-3 px-4 text-left font-semibold">Price</th>
                    <th class="py-3 px-4 text-left font-semibold">Category</th>
                    <th class="py-3 px-4 text-center font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php foreach ($devices as $device): ?>
                    <tr class="table-row">
                        <td class="py-3 px-4 border-b border-gray-200 text-center"><?= htmlspecialchars($device['device_id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="py-3 px-4 border-b border-gray-200 text-center">
                            <img src="<?= !empty($device['image']) ? '../image/imagedevice/' . htmlspecialchars($device['image'], ENT_QUOTES, 'UTF-8') : '../images/default-device.png' ?>" alt="Device Image" class="device-image">
                        </td>
                        <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($device['name'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($device['description'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="py-3 px-4 border-b border-gray-200"><?= number_format($device['price'], 2) ?> USD</td>
                        <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($device['category'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="py-3 px-4 border-b border-gray-200 text-center">
                            <div class="action-btn-container">
                                <a href="edit_device.php?id=<?= htmlspecialchars($account['account_id'], ENT_QUOTES, 'UTF-8') ?>" class="btn-primary py-1 px-4 rounded-lg text-sm inline-block mb-2 shadow-md">
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
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>