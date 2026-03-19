<?php
// cart.php
// Manages the user's shopping cart session and displays their selected items

$page_title = "Your Cart | Sound Stage";
include 'includes/header.php'; 

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// If an item was just added from index.php, save it to the session
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['album_id'])) {
    $album_id = (int)$_POST['album_id'];
    $format = $_POST['format'];
    
    // Fetches the specific album details to save in the cart
    $stmt = $pdo->prepare("SELECT title, artist, price_cd, price_vinyl FROM products WHERE id = ?");
    $stmt->execute([$album_id]);
    $album = $stmt->fetch();
    
    if ($album) {
        $price = ($format === 'vinyl') ? $album['price_vinyl'] : $album['price_cd'];
        
        $_SESSION['cart'][] = [
            'id' => $album_id,
            'title' => $album['title'],
            'artist' => $album['artist'],
            'format' => strtoupper($format),
            'price' => $price
        ];
    }
}

// Handles clearing the cart
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    $_SESSION['cart'] = [];
    header("Location: cart.php");
    exit;
}

$cart_total = 0;
?>

<main style="padding: 40px; max-width: 800px; margin: 0 auto;">
    <h2>Your Shopping Cart</h2>
    
    <div class="product-card" style="text-align: left;">
        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is currently empty. <a href="index.php" style="color: var(--card-border); font-weight: bold;">Go back to the catalogue</a>.</p>
        <?php else: ?>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <tr style="border-bottom: 2px solid var(--card-border); text-align: left;">
                    <th style="padding: 10px;">Album</th>
                    <th style="padding: 10px;">Format</th>
                    <th style="padding: 10px;">Price</th>
                </tr>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <?php $cart_total += $item['price']; ?>
                    <tr style="border-bottom: 1px solid var(--card-border);">
                        <td style="padding: 10px;"><strong><?= htmlspecialchars($item['title']) ?></strong><br><small><?= htmlspecialchars($item['artist']) ?></small></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($item['format']) ?></td>
                        <td style="padding: 10px;">$<?= number_format($item['price'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
            <h3 style="text-align: right;">Total: $<?= number_format($cart_total, 2) ?></h3>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 30px;">
                <a href="cart.php?action=clear" style="color: red; text-decoration: none; padding: 10px;">Empty Cart</a>
                
                <div style="display: flex; gap: 15px; align-items: center;">
                    <a href="index.php" style="text-decoration: none; color: var(--text-colour); font-weight: bold; transition: opacity 0.3s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">Continue Shopping</a>
                    
                    <a href="checkout.php"><button>Proceed to Checkout</button></a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<script src="js/script.js"></script>
</body>
</html>