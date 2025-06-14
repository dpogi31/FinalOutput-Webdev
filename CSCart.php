<?php
session_start();

$cart = $_SESSION['cart'] ?? [];

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Your Cart</title>

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600&family=Raleway:wght@400;500;600&family=Roboto:wght@400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="CS.css" />

    <style>
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .cart-table th,
        .cart-table td {
            padding: 10px;
            text-align: center;
            font-family: "Roboto";
        }
        .cart-controls {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 20px;
        }
        .cart-controls button {
            padding: 10px 20px;
            font-weight: bold;
            background-color:rgb(2, 102, 160);
            color: #fff;
            border-radius: 15px;
            border: none;
            cursor: pointer;
            font-family: "Roboto";
            font-size: 1em;
        }
        .cart-controls button:hover {
            background-color: rgb(59, 59, 59);
        }
        .remove-button {
            background: none;
            border: none;
            color: red;
            text-decoration: underline;
            cursor: pointer;
            font-family: "Roboto";
            font-size: 1em;
            padding: 0;
        }
        .remove-button:hover {
            color: darkred;
        }
    </style>
</head>

<body class="body1">
    <header class="navbar">
        <div class="logo"><img src="assets/images/logo1.png" alt="logo" /></div>
        <nav class="navcontainer">
            <ul class="navlinks">
                <li><a href="CSHomePage.php">Home</a></li>
                <li><a href="CSProducts.php">Products</a></li>
                <li><a href="CSCart.php">Cart</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Your Cart</h1>

        <?php if (count($cart) > 0): ?>
            <!-- Form para ma-update ang quantity -->
            <form id="cartForm" action="updateCart.php" method="post">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                <table class="cart-table" aria-label="Shopping Cart">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grandTotal = 0;
                        foreach ($cart as $index => $item):
                            $total = $item['price'] * $item['quantity'];
                            $grandTotal += $total;
                        ?>
                        <tr id="cart-item-<?= $index ?>">
                            <td><img src="<?= htmlspecialchars($item['image']) ?>" width="60" alt="<?= htmlspecialchars($item['name']) ?>" /></td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td>₱<?= number_format($item['price'], 2) ?></td>
                            <td>
                                <input type="number" name="quantities[<?= $index ?>]" value="<?= $item['quantity'] ?>" min="1" />
                            </td>
                            <td>₱<?= number_format($total, 2) ?></td>
                            <td>
                                <!-- Button para iremove ang item sa cart -->
                                <button type="button" class="remove-button" data-index="<?= $index ?>">Remove</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" style="text-align:right;"><strong>Grand Total:</strong></td>
                            <td colspan="2"><strong>₱<?= number_format($grandTotal, 2) ?></strong></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Button para i-update ang quantity -->
                <div class="cart-controls">
                    <button type="submit">Update Quantities</button>
                </div>
            </form>

            <!-- Clear Cart at Proceed to Checkout -->
            <div class="cart-controls">
                <form action="clearCart.php" method="post" style="display: inline-block;">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <button type="submit">Clear Cart</button>
                </form>

                <form action="checkout.php" method="post" style="display: inline-block;">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                    <button type="submit">Proceed to Checkout</button>
                </form>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </main>

    <footer class="footer-landing">
        <div class="footer-content">
            <h2>Chrono Sync</h2>
            <p>Stay in sync with your health, your style, and your time. Only at Chrono Sync.</p>
            <div class="footer-icons">
                <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.tiktok.com/" target="_blank"><i class="fab fa-tiktok"></i></a>
                <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                <a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 ChronoSync. All rights reserved.</p>
        </div>
    </footer>

    <!-- Script para sa pag-remove ng item via fetch API -->
    <script>
        const csrfToken = '<?= $_SESSION['csrf_token'] ?>';

        document.querySelectorAll('.remove-button').forEach(button => {
            button.addEventListener('click', () => {
                if (!confirm('Do you want to remove this?')) return;

                const index = button.getAttribute('data-index');

                fetch('removeFromCart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        index: index,
                        csrf_token: csrfToken
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = document.getElementById('cart-item-' + index);
                        if (row) {
                            row.remove();
                        }

                        // Kapag walang natirang item sa cart, ipakita na walang laman ito
                        if (document.querySelectorAll('.cart-table tbody tr').length === 1) {
                            document.querySelector('form#cartForm').style.display = 'none';
                            const main = document.querySelector('main');
                            main.insertAdjacentHTML('beforeend', '<p>Your cart is empty.</p>');
                        }
                    } else {
                        alert('Hindi maalis ang item: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => alert('Error sa pag-alis ng item: ' + error.message));
            });
        });
    </script>
</body>
</html>
