<?php
// checkout.php
// Checkout process that collects shipping info and clears the cart

$page_title = "Checkout | Sound Stage";
include 'includes/header.php'; 

// Kicks them back to the cart if it's empty
if (empty($_SESSION['cart']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: cart.php");
    exit;
}

$order_success = false;

// If they hit the "Submit Order" button
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    $_SESSION['cart'] = [];
    $order_success = true;
}
?>

<main style="padding: 40px; max-width: 600px; margin: 0 auto;">
    <?php if ($order_success): ?>
        <div class="product-card" style="text-align: center; border-color: green;">
            <h2 style="color: green;">Order Confirmed!</h2>
            <p>Thank you for your purchase. Your physical media is being packaged with care and will ship shortly.</p>
            <a href="index.php"><button style="margin-top: 20px;">Return to Catalogue</button></a>
        </div>
    <?php else: ?>
        <h2>Secure Checkout</h2>
        <div class="product-card" style="text-align: left;">
            <p>Please enter your shipping and payment details below to complete your order.</p>
            
            <form action="checkout.php" method="POST">
                <label>Full Name:</label><br>
                <input type="text" name="name" required style="width: 100%; margin-bottom: 15px; padding: 8px;"><br>
                
                <label>Shipping Address:</label><br>
                <input type="text" name="address" required style="width: 100%; margin-bottom: 15px; padding: 8px;"><br>
                
                <label>Credit Card Number (Simulated):</label><br>
                <input type="text" name="cc" placeholder="1234 5678 9101 1121" required style="width: 100%; margin-bottom: 15px; padding: 8px;"><br>
                
                <button type="submit" name="place_order" style="width: 100%; background-color: green; color: white;">Place Order</button>
            </form>
        </div>
    <?php endif; ?>
</main>

<script src="js/script.js"></script>
</body>
</html>