<?php
session_start();

// add_to_cart.php
// Kiểm tra xem sản phẩm có được gửi đến hay không
if (isset($_POST['product_id'], $_POST['product_name'], $_POST['price'], $_POST['quantity'])) {
    $product_id = htmlspecialchars($_POST['product_id']);
    $product_name = htmlspecialchars($_POST['product_name']);
    $price = (float)$_POST['price'];
    $quantity = (int)$_POST['quantity'];
    $image = isset($_POST['image']) ? htmlspecialchars($_POST['image']) : 'default_image.jpg'; // Default image if not set

    // Initialize cart if not already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add product to cart (update quantity if product already exists)
    if (isset($_SESSION['cart']['devices'][$product_id])) {
        // Nếu sản phẩm đã tồn tại, chỉ cần cập nhật số lượng
        $_SESSION['cart']['devices'][$product_id]['quantity'] += $quantity;
    } else {
        // Nếu sản phẩm chưa tồn tại, thêm mới
        $_SESSION['cart']['devices'][$product_id] = array(
            'product_name' => $product_name,
            'price' => $price,
            'quantity' => $quantity,
            'image' => '../image/imagedevice/' . $image
        );
    }


    header('Location: ../template/cart.html.php');
    exit();
} elseif (isset($_POST['package_id'], $_POST['package_name'], $_POST['price'], $_POST['quantity'])) {
    // Handle package
    $package_id = htmlspecialchars($_POST['package_id']);
    $package_name = htmlspecialchars($_POST['package_name']);
    $price = (float)$_POST['price'];
    $quantity = (int)$_POST['quantity'];
    $image = isset($_POST['image']) ? htmlspecialchars($_POST['image']) : 'default_package_image.jpg';

    // Add package to cart (update quantity if package already exists)
    if (isset($_SESSION['cart']['packages'][$package_id])) {
        // Nếu sản phẩm đã tồn tại, chỉ cần cập nhật số lượng
        $_SESSION['cart']['packages'][$package_id]['quantity'] += $quantity;
    } else {
        // Nếu sản phẩm chưa tồn tại, thêm mới
        $_SESSION['cart']['packages'][$package_id] = array(
            'package_name' => $package_name,
            'price' => $price,
            'quantity' => $quantity,
            'image' => '../image/packetimage/' . $image
        );
    }
    header('Location: ../template/cart.html.php');
    exit();
} elseif (isset($_POST['service_id'], $_POST['service_name'], $_POST['price'], $_POST['quantity'])) {
    // Handle service
    $service_id = htmlspecialchars($_POST['service_id']);
    $service_name = htmlspecialchars($_POST['service_name']);
    $price = (float)$_POST['price'];
    $quantity = (int)$_POST['quantity'];
    $image = isset($_POST['image']) ? htmlspecialchars($_POST['image']) : 'default_service_image.jpg';

    // Add service to cart (update quantity if service already exists)
    if (isset($_SESSION['cart']['services'][$service_id])) {
        // Nếu dịch vụ đã tồn tại, chỉ cần cập nhật số lượng
        $_SESSION['cart']['services'][$service_id]['quantity'] += $quantity;
    } else {
        // Nếu dịch vụ chưa tồn tại, thêm mới
        $_SESSION['cart']['services'][$service_id] = array(
            'service_name' => $service_name,
            'price' => $price,
            'quantity' => $quantity,
            'image' => '../image/serviceimage/' . $image
        );
    }

    header('Location: ../template/cart.html.php');
    exit();
}
