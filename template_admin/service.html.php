<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../style.css" rel="stylesheet">
    <style>
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

        /* Sidebar styles */
        .sidebar {
            position: absolute;
            /* Sidebar dính trong phạm vi container-content */

            /* Đảm bảo sidebar dính ở đầu container-content */
            width: 200px;
            /* Độ rộng của sidebar */
            height: auto;
            /* Chiều cao tự động theo nội dung */
            max-height: 100vh;
            /* Giới hạn chiều cao sidebar không vượt quá chiều cao của cửa sổ trình duyệt */
            background-color: white;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 1000;
            /* Đảm bảo sidebar luôn ở trên phần nội dung */
            overflow-y: auto;
            /* Cho phép sidebar cuộn nếu nội dung dài */
        }

        .sidebar a,
        .sidebar button {
            display: block;
            padding: 10px;
            color: black;
            border: none;
            border-radius: 0.375rem;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            padding-bottom: 10px;
            width: 100%;
        }

        .sidebar a:hover,
        .sidebar button:hover {
            background-color: #3182CE;
            transform: scale(1.05);
        }

        .content-container {
            margin-left: 220px;
            /* Tạo không gian bên trái cho sidebar */
            padding-top: 20px;
            /* Đảm bảo phần đầu của nội dung không bị che khuất */
            max-height: 100vh;
            /* Giới hạn chiều cao của nội dung */
            overflow-y: auto;
            /* Cho phép nội dung cuộn nếu dài */
        }

        /* Buttons specific colors */
        .btn-primary {
            background-color: #00ff00;
            border-color: #4299E1;
        }

        .btn-primary:hover {
            background-color: #3182CE;
        }

        .btn-warning {
            background-color: #ffff00;
            border-color: #F6E05E;
        }

        .btn-warning:hover {
            background-color: #D69E2E;
        }

        .btn-danger {
            background-color: #F56565;
            border-color: #F56565;
        }

        .btn-danger:hover {
            background-color: #E53E3E;
        }

        /* Flex column layout for sidebar buttons */
        .action-btn-container {
            display: flex;
            flex-direction: column;
            gap: 16px;
            /* Adds space between buttons */
        }

        /* Giữ tiêu đề cố định */
        h2 {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 2;
            /* Đảm bảo tiêu đề luôn nằm trên bảng */
            padding: 20px;
            text-align: center;
        }



        /* Tạo không gian cho bảng cuộn */
        .table-container {
            max-height: 400px;
            /* Giới hạn chiều cao của bảng */
            overflow-y: auto;
            /* Cho phép bảng cuộn dọc */
            margin-top: 20px;
        }

        /* Custom styles for the table */
        .table-header {
            background-color: #2D3748;
            color: white;
        }

        .table-row:hover {
            background-color: #F7FAFC;
        }

        .table-row {
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="action-btn-container">
            <a href="../admin/add_service.php" class="btn-primary mb-4">Add</a> <!-- Dòng 1 -->
            <a href="../admin/edit_service_list.php" class="btn-warning mb-4">Edit</a> <!-- Dòng 2 -->
            <a href="../admin/delete_service_list.php" class="btn-danger">Delete</a> <!-- Dòng 3 -->
        </div>
    </div>

    <div class="content-container max-w-6xl mx-auto bg-white text-gray-900 p-8 rounded-lg shadow-xl">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-8"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>

        <!-- Display the success or error message if it exists -->
        <?php if (isset($_GET['message'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 shadow-lg">
                <?= htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <!-- Search form -->
        <form method="get" class="mb-4">
            <div class="flex items-center space-x-4">
                <input type="text" name="search" placeholder="Search by service name" class="p-2 border rounded w-full" value="<?= htmlspecialchars($search ?? '', ENT_QUOTES, 'UTF-8') ?>" />
                <button type="submit" class="btn-primary px-4 py-2 rounded-lg" style="background-color: #3182CE;">Search</button>
            </div>
        </form>

        <!-- Table container with scrollable content -->
        <div class="table-container">
            <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
                <thead class="table-header">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold">Service ID</th>
                        <th class="py-3 px-4 text-left font-semibold">Image</th>
                        <th class="py-3 px-4 text-left font-semibold">Name</th>
                        <th class="py-3 px-4 text-left font-semibold">Description</th>
                        <th class="py-3 px-4 text-left font-semibold">Price</th>
                        <th class="py-3 px-4 text-left font-semibold">Category</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach ($services as $service): ?>
                        <tr class="table-row">
                            <td class="py-3 px-4 border-b border-gray-200 text-center"><?= htmlspecialchars($service['service_id'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="py-3 px-4 border-b border-gray-200 text-center">
                                <a href="../admin/detail_service.php?service_id=<?= $service['service_id']; ?>">
                                <?php
                                    // Check if image exists in the first folder
                                    $imagePath = '../image/serviceimage/' . htmlspecialchars($service['image'], ENT_QUOTES, 'UTF-8');

                                    // If image is not found in the first folder, check the second folder
                                    if (!file_exists($imagePath)) {
                                        $imagePath = '../upload/' . htmlspecialchars($service['image'], ENT_QUOTES, 'UTF-8');
                                    }

                                    // If the image doesn't exist in either folder, use a default image
                                    if (!file_exists($imagePath)) {
                                        $imagePath = '../images/default-service.png';
                                    }
                                    ?>
                                    <img src="<?= $imagePath ?>" alt="Service Image" class="device-image">
                                </a>
                            </td>
                            <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($service['name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td class="py-3 px-4 border-b border-gray-200"><?= number_format($service['price'], 2) ?> USD</td>
                            <td class="py-3 px-4 border-b border-gray-200"><?= htmlspecialchars($service['package_type'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>