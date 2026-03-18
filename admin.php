<?php
// admin.php
session_start();
require_once 'includes/db.php';

// Will kick anyone who isn't an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access Denied: You must be an administrator to view this page.");
}

$message = '';

// Processes the form submissions

// An admin is updating a user's status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $user_id = (int)$_POST['user_id'];
    $new_status = $_POST['status'];
    
    $stmt = $pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $user_id]);
    $message = "User status updated successfully.";
}

// An admin is updating a product's prices
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])) {
    $product_id = (int)$_POST['product_id'];
    $price_cd = (float)$_POST['price_cd'];
    $price_vinyl = (float)$_POST['price_vinyl'];
    
    $stmt = $pdo->prepare("UPDATE products SET price_cd = ?, price_vinyl = ? WHERE id = ?");
    $stmt->execute([$price_cd, $price_vinyl, $product_id]);
    $message = "Product prices updated successfully.";
}

// Fetches data to display
$users = $pdo->query("SELECT id, username, email, role, status FROM users")->fetchAll();
$products = $pdo->query("SELECT id, title, artist, price_cd, price_vinyl FROM products")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Sound Stage</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid var(--card-border); padding: 10px; text-align: left; }
        th { background-color: var(--nav-bg); }
        .admin-form { display: flex; gap: 10px; align-items: center; }
        .admin-input { width: 80px; padding: 5px; }
    </style>
</head>
<body>
<header>
    <h1>Administrator Dashboard</h1>
    <nav>
        <ul>
            <li><a href="index.php">Back to Store</a></li>
            <li><a href="monitor.php">Server Monitor</a></li>
        </ul>
    </nav>
</header>

<main style="padding: 40px; max-width: 1000px; margin: 0 auto;">
    <?php if ($message): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <h2>Manage Users</h2>
    <p>Disable accounts to prevent them from logging in.</p>
    <table>
        <tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Status Action</th></tr>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= $u['role'] ?></td>
                <td>
                    <form method="POST" class="admin-form">
                        <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                        <select name="status">
                            <option value="active" <?= $u['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="disabled" <?= $u['status'] == 'disabled' ? 'selected' : '' ?>>Disabled</option>
                        </select>
                        <button type="submit" name="update_user" style="padding: 5px 10px;">Save</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <hr style="border: 1px solid var(--card-border); margin: 40px 0;">

    <h2>Manage Inventory Pricing</h2>
    <p>Update the prices for CD and Vinyl formats. Changes will immediately reflect on the homepage.</p>
    <table>
        <tr><th>ID</th><th>Album Title</th><th>Artist</th><th>CD Price ($)</th><th>Vinyl Price ($)</th><th>Action</th></tr>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['title']) ?></td>
                <td><?= htmlspecialchars($p['artist']) ?></td>
                <form method="POST">
                    <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                    <td><input type="number" step="0.01" name="price_cd" class="admin-input" value="<?= $p['price_cd'] ?>"></td>
                    <td><input type="number" step="0.01" name="price_vinyl" class="admin-input" value="<?= $p['price_vinyl'] ?>"></td>
                    <td><button type="submit" name="update_product" style="padding: 5px 10px;">Update</button></td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<script src="js/script.js"></script>
</body>
</html>