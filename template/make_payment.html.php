<?php
session_start();
include '../include/database.php';
//make payment
// Initialize cart items and total
$cart_items = [];
$total = 0;
$special_offer_id = isset($_POST['special_offer_id']) ? $_POST['special_offer_id'] : null;
$special_offer = null;

// Fetch special offer details if provided
if ($special_offer_id) {
    $sql = "SELECT * FROM special_offer WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $special_offer_id]);
    $special_offer = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fetch cart items from session
if (isset($_SESSION['cart'])) {
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
                'image' => $product['image']
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
                'image' => $package['image']
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
                'image' => $service['image']
            ];
        }
    }
}

// If there's a special offer, apply the discount
if ($special_offer) {
    $discount = ($special_offer['discount_percentage'] / 100) * $total;
    $total -= $discount;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Payment</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="../styles.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        .total-price {
            color: red;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .special-offer-label {
            font-weight: 600;
        }

        .confirm-btn {
            background-color: #ff4d4d; /* Red color */
            color: white;
            transition: background-color 0.3s ease;
        }

        .confirm-btn:hover {
            background-color: #e60000; /* Darker red on hover */
        }

        .back-btn {
            background-color: white;
            color: black;
            border: 2px solid #ddd;
            transition: background-color 0.3s ease, border 0.3s ease;
        }

        .back-btn:hover {
            background-color: #f0f0f0; /* Gray background on hover */
            border-color: #ccc;
        }
    </style>
</head>

<body class="bg-background">
    <div class="flex flex-col md:flex-row p-6 bg-background">
        <div class="w-full md:w-1/2 bg-card p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4">Product List:</h2>
            <div class="space-y-4">
                <?php foreach ($cart_items as $item): ?>
                    <div class="flex items-center justify-between border-b py-2">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="Product image" class="w-24 h-24 object-cover" />
                        <div class="flex-1 mx-4">
                            <p class="font-medium"><?php echo htmlspecialchars($item['name']); ?></p>
                            <p class="text-muted-foreground">$<?php echo number_format($item['price'], 2); ?></p>
                        </div>
                        <span class="font-medium"><?php echo htmlspecialchars($item['quantity']); ?> pcs</span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-4 font-semibold">
                <p class="total-price">Total: $<?php echo number_format($total, 2); ?></p>
            </div>

            <div class="mt-4 flex items-center">
                <label class="block special-offer-label mr-2">Special Offer:</label>
                <?php if ($special_offer): ?>
                    <p class="font-medium"><?php echo htmlspecialchars($special_offer['name']); ?> - <?php echo htmlspecialchars($special_offer['discount_percentage']); ?> %</p>
                <?php else: ?>
                    <p class="text-muted-foreground">No special offer applied.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Payment Form -->
        <div class="w-full md:w-1/2 bg-card p-4 rounded-lg shadow-md md:ml-4">
            <h2 class="text-lg font-semibold mb-4">Personal Information:</h2>
            <form class="space-y-4">
                <div>
                    <label class="block">Name:</label>
                    <input type="text" class="border rounded p-2 w-full" placeholder="Enter your name" />
                </div>
                <div>
                    <label class="block">Phone number:</label>
                    <input type="tel" class="border rounded p-2 w-full" placeholder="Enter your phone number" />
                </div>
                <div>
                    <label class="block">Address:</label>
                    <input type="text" class="border rounded p-2 w-full" placeholder="Enter your address" />
                </div>
                <div>
                    <label class="block">Card Number:</label>
                    <input type="text" class="border rounded p-2 w-full" placeholder="Enter card number" />
                </div>
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label class="block">Expiration Date:</label>
                        <input type="text" class="border rounded p-2 w-full" placeholder="MM/YY" />
                    </div>
                    <div class="flex-1">
                        <label class="block">CV Code:</label>
                        <input type="text" class="border rounded p-2 w-full" placeholder="CVV" />
                    </div>
                </div>
                <div class="flex justify-between mt-4">
                    <button type="button" class="back-btn p-2 rounded">BACK</button>
                    <button type="submit" class="confirm-btn p-2 rounded">Confirm Payment</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
