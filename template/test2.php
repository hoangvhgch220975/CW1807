<?php
session_start();

// add_to_cart.php
// Kiểm tra xem sản phẩm có được gửi đến hay không
if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['price']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = intval($_POST['quantity']);
    $image = isset($_POST['image']) ? $_POST['image'] : 'default_image.jpg'; // Default image if not set

    // Initialize cart if not already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if product already exists in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = array(
            'product_name' => $product_name,
            'price' => $price,
            'quantity' => $quantity,
            'image' => '../image/imagedevice/' . $image // Add directory path for product images
        );
    }

    // Chuyển hướng người dùng đến trang giỏ hàng
    header('Location: ../template/cart.html.php');
    exit();

} elseif (isset($_POST['package_id']) && isset($_POST['package_name']) && isset($_POST['price']) && isset($_POST['quantity'])) {
    // Xử lý gói
    $package_id = $_POST['package_id'];
    $package_name = $_POST['package_name'];
    $price = $_POST['price'];
    $quantity = intval($_POST['quantity']);
    $image = $_POST['image'] ?: 'default_package_image.jpg';  // Default image if not set for package

    // Kiểm tra nếu giỏ hàng chưa được tạo trong session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Kiểm tra nếu gói đã có trong giỏ hàng
    if (isset($_SESSION['cart'][$package_id])) {
        // Cộng thêm số lượng vào gói trong giỏ hàng
        $_SESSION['cart'][$package_id]['quantity'] += $quantity;
    } else {
        // Nếu chưa có, thêm gói vào giỏ hàng
        $_SESSION['cart'][$package_id] = array(
            'package_name' => $package_name,
            'price' => $price,
            'quantity' => $quantity,
            'image' => '../image/packetimage/' . $image // Add directory path for package images
        );
    }

    // Chuyển hướng người dùng đến trang giỏ hàng
    header('Location: ../template/cart.html.php');
    exit();
} else {
    // Nếu không có dữ liệu sản phẩm, chuyển hướng về trang chi tiết sản phẩm
    header('Location: detail_device.php?device_id=' . $_POST['product_id']);
    exit();
}
?>
