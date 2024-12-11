<?php
session_start();
include '../include/database.php';
include '../include/databasefunction.php';
//checkout
// Fetch special offers from the database
$sql = "SELECT * FROM special_offer";
$result = $pdo->query($sql);
$special_offers = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $special_offers[] = $row;
}

// Calculate the total price of cart items
$total = 0;
$cart_items = [];
$special_offer_id = null; // Initialize special offer variable

if (isset($_SESSION['cart'])) {
    // Process Devices
    if (isset($_SESSION['cart']['devices'])) {
        foreach ($_SESSION['cart']['devices'] as $product_id => $product) {
            $product_name = htmlspecialchars($product['product_name']);
            $price = (float)($product['price']);
            $quantity = (int)($product['quantity']);
            $total += $quantity * $price;
            $cart_items[] = [
                'type' => 'device',
                'id' => $product_id,
                'name' => $product_name,
                'quantity' => $quantity,
                'price' => $price,
                'image' => $product['image'] // Assuming you have an 'image' field in your product data
            ];
        }
    }

    // Process Packages
    if (isset($_SESSION['cart']['packages'])) {
        foreach ($_SESSION['cart']['packages'] as $package_id => $package) {
            $package_name = htmlspecialchars($package['package_name']);
            $price = (float)($package['price']);
            $quantity = (int)($package['quantity']);
            $total += $quantity * $price;
            $cart_items[] = [
                'type' => 'package',
                'id' => $package_id,
                'name' => $package_name,
                'quantity' => $quantity,
                'price' => $price,
                'image' => $package['image'] // Assuming you have an 'image' field in your package data
            ];
        }
    }

    // Process Services
    if (isset($_SESSION['cart']['services'])) {
        foreach ($_SESSION['cart']['services'] as $service_id => $service) {
            $service_name = htmlspecialchars($service['service_name']);
            $price = (float)($service['price']);
            $quantity = (int)($service['quantity']);
            $total += $quantity * $price;
            $cart_items[] = [
                'type' => 'service',
                'id' => $service_id,
                'name' => $service_name,
                'quantity' => $quantity,
                'price' => $price,
                'image' => $service['image'] // Assuming you have an 'image' field in your service data
            ];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="../styles.css" rel="stylesheet">
    <script>
        function updateTotal() {
            var specialOfferId = document.getElementById('special_offer').value;
            var total = parseFloat(document.getElementById('total-price').getAttribute('data-total'));
            
            // Fetch special offers from the PHP array
            var specialOffers = <?php echo json_encode($special_offers); ?>;
            var discount = 0;

            // Find the selected offer and apply discount
            specialOffers.forEach(function(offer) {
                if (offer.id == specialOfferId) {
                    discount = offer.discount_percentage;
                }
            });

            // Calculate the new total with the discount
            var newTotal = total - (total * discount / 100);
            document.getElementById('total-price').innerText = '$' + newTotal.toFixed(2);
        }
    </script>
    <style>
        /* Red Tone Theme */
        body {
            background-color: #fef2f2;
            font-family: 'Arial', sans-serif;
            padding-top: 5%;
        }

        .max-w-4xl {
            max-width: 100rem;
            margin: 0 auto;
            padding: 1.5rem;
            margin-bottom: 5%;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .shadow-lg {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .rounded-lg {
            border-radius: 0.75rem;
        }

        .text-2xl {
            font-size: 1.5rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .space-y-4 {
            margin-top: 1rem;
        }

        .border-b {
            border-bottom: 1px solid #fca5a5;
        }

        .pb-2 {
            padding-bottom: 0.5rem;
        }

        .mx-4 {
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .w-16 {
            width: 4rem;
        }

        .ml-4 {
            margin-left: 1rem;
        }

        .font-semibold {
            font-weight: 600;
            color: #991b1b;
        }

        .bg-gray-200 {
            background-color: #fca5a5;
        }

        .text-gray-800 {
            color: #6b7280;
        }

        .hover\:bg-gray-300:hover {
            background-color: #f87171;
        }

        .bg-red-600 {
            background-color: #dc2626;
        }

        .text-white {
            color: white;
        }

        .hover\:bg-red-700:hover {
            background-color: #b91c1c;
        }

        .p-2 {
            padding: 0.5rem;
        }

        .rounded {
            border-radius: 0.375rem;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .mt-6 {
            margin-top: 1.5rem;
        }

        .text-blue-600 {
            color: #2563eb;
        }

        .text-red-600 {
            color: #dc2626;
        }

        .text-gray-800 {
            color: #1f2937;
        }

        .select {
            border: 1px solid #fca5a5;
            padding: 0.5rem;
            border-radius: 0.375rem;
            color: #991b1b;
        }

        a {
            color: #828282;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        input[type="number"] {
            border: 1px solid #fca5a5;
            padding: 0.5rem;
            border-radius: 0.375rem;
            width: 4rem;
            font-size: 1rem;
            text-align: center;
        }

        /* Hover effects */
        .product:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        .btn-red {
            background-color: #dc2626;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-red:hover {
            background-color: #b91c1c;
            transform: scale(1.05);
        }

        /* Image styling */
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.375rem;
        }
    </style>
</head>

<body class="bg-gray-50">

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Your Cart</h2>

        <?php if (!empty($cart_items)): ?>
            <div class="space-y-4">
                <?php foreach ($cart_items as $item): ?>
                    <div class="flex items-center justify-between border-b pb-2">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="product-img">
                        <span class="flex-1 mx-4"><?php echo htmlspecialchars($item['name']); ?></span>
                        <input type="number" class="border rounded p-1 w-16" value="<?php echo $item['quantity']; ?>" min="1" />
                        <span class="ml-4">$<?php echo number_format($item['price'], 2); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <form method="POST" action="">
                <div class="flex items-center justify-between mt-4">
                    <select id="special_offer" name="special_offer_id" class="border rounded p-2" onchange="updateTotal()">
                        <option value="">Choose a Special Offer</option>
                        <?php foreach ($special_offers as $offer): ?>
                            <option value="<?php echo $offer['id']; ?>"><?php echo htmlspecialchars($offer['name']); ?> (<?php echo $offer['discount_percentage']; ?>% off)</option>
                        <?php endforeach; ?>
                    </select>
                    <span class="font-semibold" id="total-price" data-total="<?php echo $total; ?>">Total: $<?php echo number_format($total, 2); ?></span>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="../template/cart.html.php" class=" text-gray-800 hover:bg-gray-500 p-2 rounded">Back to Cart</a>
                    <a href="../customer/make_payment.php" class="btn-red">Process to Payment</a>
                </div>
            </form>

        <?php else: ?>
            <p>Your cart is empty. <a href="../customer/index_user.php" class="text-blue-600">Start shopping</a></p>
        <?php endif; ?>
    </div>

</body>

</html>
