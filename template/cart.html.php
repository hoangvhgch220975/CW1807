<?php
session_start();

// cart.html.php
// Xử lý cập nhật giỏ hàng hoặc xóa sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cập nhật số lượng sản phẩm trong giỏ hàng
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $new_quantity = $_POST['quantity'];

        // Kiểm tra sản phẩm có trong giỏ không
        if (isset($_SESSION['cart']['devices'][$product_id])) {
            $_SESSION['cart']['devices'][$product_id]['quantity'] = $new_quantity;
            echo json_encode(['status' => 'success', 'message' => 'Cart updated successfully.']);
        } elseif (isset($_SESSION['cart']['packages'][$product_id])) {
            $_SESSION['cart']['packages'][$product_id]['quantity'] = $new_quantity;
            echo json_encode(['status' => 'success', 'message' => 'Cart updated successfully.']);
        } elseif (isset($_SESSION['cart']['services'][$product_id])) {
            $_SESSION['cart']['services'][$product_id]['quantity'] = $new_quantity;
            echo json_encode(['status' => 'success', 'message' => 'Cart updated successfully.']);
        }
    }

    // Xóa sản phẩm khỏi giỏ hàng
    if (isset($_POST['remove_product_id'])) {
        $product_id = $_POST['remove_product_id'];

        if (isset($_SESSION['cart']['devices'][$product_id])) {
            unset($_SESSION['cart']['devices'][$product_id]); // Xóa sản phẩm khỏi giỏ
            echo json_encode(['status' => 'success', 'message' => 'Product removed successfully.']);
        } elseif (isset($_SESSION['cart']['packages'][$product_id])) {
            unset($_SESSION['cart']['packages'][$product_id]); // Xóa sản phẩm khỏi giỏ
            echo json_encode(['status' => 'success', 'message' => 'Product removed successfully.']);
        } elseif (isset($_SESSION['cart']['services'][$product_id])) {
            unset($_SESSION['cart']['services'][$product_id]); // Xóa sản phẩm khỏi giỏ
            echo json_encode(['status' => 'success', 'message' => 'Product removed successfully.']);
        }
    }
    exit; // Dừng script sau khi xử lý POST
}






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h2 {
            color: #b30000;
            font-size: 24px;
            margin-bottom: 20px;
            margin-right: 88%;
        }

        h3 {
            color: #b30000;
            font-size: 32px;
            margin-top: 20px;
            margin-left: 85%;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            margin-top: 50px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #b30000;
            color: white;
        }

        td {
            background-color: #fff;
        }

        .remove {
            background-color: #b30000;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 14px;
        }

        .remove:hover {
            background-color: #a30000;
        }

        .quantity {
            width: 80px;
            padding: 10px;
            font-size: 20px;
            text-align: center;
            border: 2px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .quantity:hover {
            border-color: #b30000;
        }

        #total {
            color: #b30000;
            font-weight: bold;
            font-size: 24px;
        }

        a {
            color: #b30000;
            text-decoration: none;
            font-weight: bold;
            margin: 10px;
            font-size: 24px;
        }

        a:hover {
            text-decoration: underline;
        }

        .empty-cart-message {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        /* Di chuyển các liên kết lên góc trên bên phải */
        .checkout-links {
            position: absolute;
            top: 20px;
            right: 20px;
            gap: 20px;
            /* Khoảng cách giữa các nút */
            display: flex;
            margin-bottom: 25px; /* Thêm margin-bottom để cách dưới một chút */


        }

        .checkout-links a {
            margin: 0 10px;
            color: #b30000;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            padding: 10px 20px;
            border: 1px solid #b30000;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .checkout-links a:hover {
            background-color: #b30000;
            color: white;
        }
    </style>
</head>

<body>
    
    <?php

    // Kiểm tra giỏ hàng có sản phẩm không
    if (isset($_SESSION['cart']) && (
        (isset($_SESSION['cart']['devices']) && count($_SESSION['cart']['devices']) > 0) ||
        (isset($_SESSION['cart']['packages']) && count($_SESSION['cart']['packages']) > 0) ||
        (isset($_SESSION['cart']['services']) && count($_SESSION['cart']['services']) > 0)
    )) {
        $total = 0;
        echo "<h2>Your Shopping Cart</h2>";
        echo "<table>
            <tr>
                <th>Item ID</th>
                <th>Image</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th></th>
            </tr>";
            

       

        // Duyệt qua các loại sản phẩm trong giỏ hàng
        // Devices
        
        if (isset($_SESSION['cart']['devices'])) {
            foreach ($_SESSION['cart']['devices'] as $product_id => $product) {
                $product_name = htmlspecialchars($product['product_name']);
                $image = htmlspecialchars($product['image']);
                $price = (float)($product['price']);
                $quantity = (int)($product['quantity']);
                $subtotal = $quantity * $price;
                $total += $subtotal;

                echo "<tr>
                    <td style='font-size: 20px'>" . htmlspecialchars($product_id) . "</td>
                    <td><img src='" . $image . "' alt='" . $product_name . "' style='width: 150px;'></td>
                    <td style='font-size: 20px'>" . $product_name . "</td>
                    <td style='font-size: 24px'>$" . number_format($price, 2) . "</td>
                    <td><input style='font-size: 24px' type='number' class='quantity' value='" . $quantity . "' min='1' data-product-id='" . $product_id . "'></td>
                    <td style='font-size: 24px' class='subtotal' id='subtotal_" . $product_id . "'>$" . number_format($subtotal, 2) . "</td>
                    <td><button style='font-size: 20px'class='remove' data-remove-product-id='" . $product_id . "'>Remove</button></td>
                </tr>";
            }
        }

        // Packages
        if (isset($_SESSION['cart']['packages'])) {
            foreach ($_SESSION['cart']['packages'] as $package_id => $package) {
                $package_name = htmlspecialchars($package['package_name']);
                $image = htmlspecialchars($package['image']);
                $price = (float)($package['price']);
                $quantity = (int)($package['quantity']);
                $subtotal = $quantity * $price;
                $total += $subtotal;

                echo "<tr>
                    <td style='font-size: 20px'>" . htmlspecialchars($package_id) . "</td>
                    <td><img src='" . $image . "' alt='" . $package_name . "' style='width: 150px;'></td>
                    <td style='font-size: 20px'>" . $package_name . "</td>
                    <td style='font-size: 24px'>$" . number_format($price, 2) . "</td>
                    <td ><input style='font-size: 24px' type='number' class='quantity' value='" . $quantity . "' min='1' data-product-id='" . $package_id . "'></td>
                    <td style='font-size: 24px'class='subtotal' id='subtotal_" . $package_id . "'>$" . number_format($subtotal, 2) . "</td>
                    <td><button style='font-size: 20px'class='remove' data-remove-product-id='" . $package_id . "'>Remove</button></td>
                </tr>";
            }
        }

        // Services
        if (isset($_SESSION['cart']['services'])) {
            foreach ($_SESSION['cart']['services'] as $service_id => $service) {
                $service_name = htmlspecialchars($service['service_name']);
                $image = htmlspecialchars($service['image']);
                $price = (float)($service['price']);
                $quantity = (int)($service['quantity']);
                $subtotal = $quantity * $price;
                $total += $subtotal;

                echo "<tr>
                    <td style='font-size: 20px'>" . htmlspecialchars($service_id) . "</td>
                    <td><img src='" . $image . "' alt='" . $service_name . "' style='width: 150px;'></td>
                    <td style='font-size: 20px'>" . $service_name . "</td>
                    <td style='font-size: 24px'>$" . number_format($price, 2) . "</td>
                    <td><input style='font-size: 24px' type='number' class='quantity' value='" . $quantity . "' min='1' data-product-id='" . $service_id . "'></td>
                    <td style='font-size: 24px'class='subtotal' id='subtotal_" . $service_id . "'>$" . number_format($subtotal, 2) . "</td>
                    <td><button style='font-size: 20px'class='remove' data-remove-product-id='" . $service_id . "'>Remove</button></td>
                </tr>";
            }
        }

        // Hiển thị tổng giá trị giỏ hàng
        echo "</table>
            <h3 >Total: $" . number_format($total, 2) . "</h3>";

        echo "<div class='checkout-links'>
            <a href='../customer/checkout.php'>Proceed to Checkout </a>
            <a href='../customer/index_user.php'>Continue Shopping</a>
        </div>";
    } else {
        echo "<div class='empty-cart-message'>
            <h3>Your cart is empty.</h3>
            <a href='../customer/index_user.php'>Continue Shopping</a>
        </div>";
    }
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Xử lý thay đổi số lượng sản phẩm
            document.querySelectorAll('.quantity').forEach(input => {
                input.addEventListener('change', function() {
                    const productId = this.getAttribute('data-product-id');
                    const newQuantity = this.value;
                    const price = parseFloat(this.closest('tr').querySelector('td:nth-child(4)').textContent.replace('$', '').trim());
                    const subtotalCell = this.closest('tr').querySelector('.subtotal');
                    const newSubtotal = newQuantity * price;

                    subtotalCell.textContent = `$${newSubtotal.toFixed(2)}`;
                    updateTotal();

                    // Gửi yêu cầu AJAX để cập nhật số lượng
                    fetch('', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `product_id=${productId}&quantity=${newQuantity}`
                    }).then(response => response.json()).then(data => {
                        console.log(data.message);
                    });
                });
            });

            // Xử lý sự kiện xóa sản phẩm
            document.querySelectorAll('.remove').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-remove-product-id');
                    fetch('', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `remove_product_id=${productId}`
                    }).then(response => response.json()).then(data => {
                        if (data.status === 'success') {
                            this.closest('tr').remove();
                            updateTotal();
                        }
                    });
                });
            });

            // Cập nhật tổng giá trị giỏ hàng
            function updateTotal() {
                let total = 0;
                document.querySelectorAll('.subtotal').forEach(subtotalCell => {
                    total += parseFloat(subtotalCell.textContent.replace('$', '').trim());
                });
                document.querySelector('h3').textContent = `Total: $${total.toFixed(2)}`;
            }
        });
    </script>
</body>


</html>