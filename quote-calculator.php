<?php
// quote-calculator.php
require_once 'includes/db.php';

$quote_result = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = (int)$_POST['quantity'];
    $color = $_POST['color'];
    $packaging = $_POST['packaging'];

    // Base price per record
    $base_price = 10.00;

    // Modifiers
    if ($color == 'color') $base_price += 2.00;
    if ($color == 'splatter') $base_price += 4.50;
    
    if ($packaging == 'gatefold') $base_price += 3.00;

    // Bulk discount logic
    $total = $base_price * $quantity;
    if ($quantity >= 500) {
        $total = $total * 0.90; // 10% discount
    }

    $quote_result = $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Custom Vinyl Quote | Sound Stage</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Custom Vinyl Pressing</h1>
    <nav><ul><li><a href="index.php">Back to Store</a></li></ul></nav>
</header>

<main style="padding: 40px; max-width: 600px; margin: 0 auto;">
    <h2>Get a Pressing Quote</h2>
    <p>Are you an artist? Use this dynamic form to calculate the cost of pressing your own album!</p>

    <div class="product-card" style="text-align: left;">
        <form action="quote-calculator.php" method="POST">
            <label>Quantity (Minimum 100):</label><br>
            <input type="number" name="quantity" min="100" value="100" required style="width: 100%; margin-bottom: 15px; padding: 5px;"><br>

            <label>Vinyl Color:</label><br>
            <select name="color" style="width: 100%; margin-bottom: 15px; padding: 5px;">
                <option value="black">Standard Black</option>
                <option value="color">Solid Color (+$2.00/ea)</option>
                <option value="splatter">Custom Splatter (+$4.50/ea)</option>
            </select><br>

            <label>Packaging:</label><br>
            <select name="packaging" style="width: 100%; margin-bottom: 15px; padding: 5px;">
                <option value="standard">Standard Sleeve</option>
                <option value="gatefold">Gatefold Sleeve (+$3.00/ea)</option>
            </select><br>

            <button type="submit" style="width: 100%;">Calculate My Quote</button>
        </form>

        <?php if ($quote_result !== null): ?>
            <div style="margin-top: 20px; padding: 15px; background-color: var(--nav-bg); border-radius: 5px; text-align: center;">
                <h3>Estimated Total: $<?= number_format($quote_result, 2) ?></h3>
                <?php if ($quantity >= 500) echo "<p style='color: green;'><em>Includes 10% bulk discount!</em></p>"; ?>
            </div>
        <?php endif; ?>
    </div>
</main>
<script src="js/script.js"></script>
</body>
</html>