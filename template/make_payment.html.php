<?php
session_start();

// Initialize the cart items and total
$cart_items = [];
$total = 0;
$special_offer_id = isset($_POST['special_offer_id']) ? $_POST['special_offer_id'] : null;
$special_offer = null;

// Fetch the special offer details from the database
if ($special_offer_id) {
    $sql = "SELECT * FROM special_offer WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $special_offer_id]);
    $special_offer = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($special_offer) {
    $discount = ($special_offer['discount_percentage'] / 100) * $total;
    $total -= $discount;
}
// Lấy thông tin sản phẩm từ giỏ hàng (cart) và thông tin special offer
$cart_items = [];
$total = 0;
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Payment</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
    <link href="../styles.css" rel="stylesheet">
    <style>
        /* Custom Styles */
         /* Red Tone Theme */
         body {
            background-color: #f3f4f6;
            font-family: 'Arial', sans-serif;
            padding-top: 5%;
        }

        .max-w-4xl {
            max-width: 100rem;
            margin: 0 auto;
            padding: 1.5rem;
            margin-bottom: 5%;
        }
    </style>
</head>

<body class="bg-background">

    <div class="flex flex-col md:flex-row p-6 bg-background">
        <!-- Product List -->
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
                <p>Total: $<?php echo number_format($total, 2); ?></p>
            </div>

            <div class="mt-4">
                <label class="block mb-2">Special Offer:</label>
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
                    <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded">BACK</button>
                    <button class="bg-destructive text-destructive-foreground hover:bg-destructive/80 p-2 rounded">Confirm Payment</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
