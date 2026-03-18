<?php
// cart.php
require_once 'includes/db.php';

// Checks if data was sent using the form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['album_id'])) {
    $album_id = (int)$_POST['album_id'];
    $format = htmlspecialchars($_POST['format']);
    
    // Fetches specific album from my database to get name and price of it
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$album_id]);
    $album = $stmt->fetch();
    
    if ($album) {
        // Determines which price to use based on the chosen options
        $price = ($format === 'vinyl') ? $album['price_vinyl'] : $album['price_cd'];
        $format_display = ($format === 'vinyl') ? 'Vinyl Record' : 'Standard CD';
    } else {
        $error = "Album not found in catalogue.";
    }
} else {
    $error = "No item was added to the cart.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | Music Emporium</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Shopping Cart</h1>
    <nav>
        <ul>
            <li><a href="index.php">Back to Catalogue</a></li>
        </ul>
    </nav>
</header>

<main style="padding: 40px; text-align: center;">
    <?php if (isset($error)): ?>
        <h2>Oops!</h2>
        <p><?= $error ?></p>
        <a href="index.php"><button>Return to Shop</button></a>
    <?php else: ?>
        <h2>Item Successfully Added!</h2>
        <div class="product-card" style="max-width: 400px; margin: 0 auto;">
            <h3><?= htmlspecialchars($album['title']) ?></h3>
            <p><strong>Artist:</strong> <?= htmlspecialchars($album['artist']) ?></p>
            <p><strong>Format:</strong> <?= $format_display ?></p>
            <p><strong>Total Price:</strong> $<?= number_format($price, 2) ?></p>
            
            <br>
            <button onclick="alert('Checkout functionality coming soon!')">Proceed to Checkout</button>
        </div>
    <?php endif; ?>
</main>

<script src="js/script.js"></script>
</body>
</html>