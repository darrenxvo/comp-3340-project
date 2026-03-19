<?php
// index.php
// Main catalogue page displaying all products dynamically.

// SEO for this specific page
$page_title = "Home | Sound Stage";
$meta_desc = "Browse our massive catalogue of premium Vinyl and CD albums.";

// Gets the centralized header, which handles the session, database, and navigation bar
include 'includes/header.php'; 

// Fetches all the different albums from my database
try {
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Could not fetch products: " . $e->getMessage());
}
?>

<main class="product-grid">
    <?php foreach ($products as $album): ?>
        <div class="product-card">
            
            <img src="images/<?= htmlspecialchars($album['image_url']) ?>" alt="<?= htmlspecialchars($album['title']) ?>" style="width: 100%; height: 250px; object-fit: cover; border-radius: 4px; margin-bottom: 15px;">
            
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