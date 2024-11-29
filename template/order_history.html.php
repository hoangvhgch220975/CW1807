<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding-top: 150px;
            background-color: #f8f9fa;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        h1 {
            text-align: left;
            color: #333;
            font-weight: normal;
            font-size: 40px;
            margin-bottom: 20px;
            padding-left: 10% ;
        }

        .order-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(1200px, 1fr));
            gap: 20px;
        }


        .order-item {
            display: flex;
            align-items: center;
            /* Căn giữa theo chiều dọc */
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;;
            padding-left: 20px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
            /* Căn trái cho văn bản */
        }

        .order-item img {
            width: 290px;
            height: 290px;
            object-fit: contain;
            border-radius: 8px;
            margin-right: 30px;
            /* Thêm khoảng cách bên phải của hình ảnh */
        }

        .order-details {
            flex: 1;
            /* Để phần chi tiết chiếm không gian còn lại */
        }

        .order-details h3 {
            margin: 0;
            font-size: 35px;
            color: #007bff;
            /* Giảm khoảng cách dưới tiêu đề */
        }

        .order-details p {
            margin: 5px 0;
            font-size: 20px;
            color: #333;
        }

        
        .status {
            display: inline-block;
            font-size: 20px;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .status.pending {
            background-color: #ffc107;
            color: #000;
        }

        .status.confirmed {
            background-color: #17a2b8;
            color: #fff;
        }

        .status.shipping {
            background-color: #007bff;
            color: #fff;
        }

        .status.completed {
            background-color: #28a745;
            color: #fff;
        }

        .status.cancelled {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>

<body>
    <h1>Your order history</h1>

    <div class="container">

        <?php if (empty($orders)): ?>
            <p style="color: #555;">You have no orders yet.</p>
        <?php else: ?>
            <div class="order-grid">
                <?php foreach ($orders as $order): ?>
                    <div class="order-item">
                        <?php
                        // Xác định thư mục dựa trên product_type
                        $folder = '';
                        switch ($order['product_type']) {
                            case 'device':
                                $folder = 'imagedevice';
                                break;
                            case 'package':
                                $folder = 'packetimage';
                                break;
                            case 'service':
                                $folder = 'serviceimage';
                                break;
                        }
                        ?>
                        <img src="../image/<?= $folder ?>/<?= htmlspecialchars($order['image']) ?>"
                            alt="<?= htmlspecialchars($order['product_name']) ?>">

                        <div class="order-details">
                            <h3 style="color: #000;"><?= htmlspecialchars($order['product_name']) ?></h3>
                            <p id="p1"><strong>x</strong> <?= htmlspecialchars($order['quantity']) ?></p>
                            <p id="p2"><strong></strong> $<?= htmlspecialchars(number_format($order['total_price'], 2)) ?></p>
                            <p id="p3"><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
                            <span class="status <?= htmlspecialchars($order['status']) ?>">
                                <?= ucfirst(htmlspecialchars($order['status'])) ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>