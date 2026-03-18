<?php
// index.php
// Connect to the database
require_once 'includes/db.php'; 

// Fetches all the different albums from my database
try {
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Could not fetch products: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sound Stage | Shop Vinyl & CDs</title>
    <meta name="description" content="A curated selection of the best albums on Vinyl and CD.">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Sound Stage</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="wiki/help-index.php">Help</a></li>
        </ul>
        <select id="theme-selector">
            <option value="light">Regular Theme</option>
            <option value="dark">Dark Theme</option>
            <option value="retro">Retro Theme</option>
        </select>
    </nav>
</header>

<main class="product-grid">
    <?php foreach ($products as $album): ?>
        <div class="product-card">
            <div class="image-placeholder">💿 Image: <?= htmlspecialchars($album['image_url']) ?></div>
            
            <h3><?= htmlspecialchars($album['title']) ?></h3>
            <p><em><?= htmlspecialchars($album['artist']) ?></em></p>

            <form action="cart.php" method="POST">
                <input type="hidden" name="album_id" value="<?= $album['id'] ?>">
                <label>Format:</label>
                <select name="format">
                    <option value="cd">CD - $<?= number_format($album['price_cd'], 2) ?></option>
                    <option value="vinyl">Vinyl - $<?= number_format($album['price_vinyl'], 2) ?></option>
                </select>
                <button type="submit" style="margin-top: 10px;">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</main>

<script src="js/script.js"></script>
</body>
</html>