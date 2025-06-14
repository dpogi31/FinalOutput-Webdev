<?php
session_start();
require 'db_connect.php'; //  Required for $conn

//  CSRF protection
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Invalid CSRF token. Action denied.");
}

//  Get cart from session
$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    echo "Cart is empty!";
    exit();
}

//  Compute total amount
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

//  Insert into `orders` table
$stmt = $conn->prepare("INSERT INTO orders (total_amount) VALUES (?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("d", $total);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}
$order_id = $stmt->insert_id;
$stmt->close();

//  Insert each item into `order_items`
$stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, price, quantity, subtotal) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare for order_items failed: " . $conn->error);
}

foreach ($cart as $item) {
    $name = $item['name'];
    $price = $item['price'];
    $qty = $item['quantity'];
    $subtotal = $price * $qty;
    $stmt->bind_param("isdid", $order_id, $name, $price, $qty, $subtotal);
    if (!$stmt->execute()) {
        die("Item insert failed: " . $stmt->error);
    }
}
$stmt->close();

//  Clear cart
unset($_SESSION['cart']);
?>

<!--  Styled confirmation page -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Order Confirmation</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600&family=Raleway:wght@400;500;600&family=Roboto:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url(assets/images/IFL.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }

        .confirmation-container {
            max-width: 600px;
            margin: 80px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .confirmation-container h1 {
            color: #008fe2;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .confirmation-container p {
            font-size: 1.1em;
            margin-bottom: 30px;
            color: #333;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .button-group a {
            display: inline-block;
            padding: 12px 25px;
            background-color: #008fe2;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        .button-group a:hover {
            background-color: #333;
        }

        .success-icon {
            font-size: 60px;
            color: #28a745;
            margin-bottom: 20px;
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="confirmation-container">
        <div class="success-icon"><i class="fas fa-check-circle"></i></div>
        <h1>Thank You!</h1>
        <p>Your order has been placed successfully. Your order ID is
            <strong>#<?= htmlspecialchars($order_id) ?></strong>.</p>

        <div class="button-group">
            <a href="CSHomePage.php">Back to Home</a>
            <a href="CSProducts.php">Shop More</a>
        </div>
    </div>
</body>

</html>