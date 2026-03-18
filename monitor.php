<?php
// monitor.php
session_start();

// Only lets the admins view this page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access Denied: You must be an administrator to view server status.");
}

$db_status = 'Offline 🔴';
$db_color = 'red';

// Tests database connection
try {
    require_once 'includes/db.php';
    if ($pdo) {
        $db_status = 'Online 🟢';
        $db_color = 'green';
    }
} catch (Exception $e) {
    $db_status = 'Offline 🔴 - Error: ' . $e->getMessage();
}

// Tests PHP service
$php_status = phpversion() ? 'Online 🟢 (v' . phpversion() . ')' : 'Offline 🔴';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Server Monitor | Sound Stage</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>System Monitoring</h1>
    <nav><ul><li><a href="index.php">Back to Store</a></li></ul></nav>
</header>

<main style="padding: 40px; max-width: 600px; margin: 0 auto;">
    <h2>Service Status</h2>
    <div class="product-card" style="text-align: left;">
        <p><strong>MySQL Database Connection:</strong> <span style="color: <?= $db_color ?>; font-weight: bold;"><?= $db_status ?></span></p>
        <p><strong>PHP Backend Processor:</strong> <span style="color: green; font-weight: bold;"><?= $php_status ?></span></p>
        <p><strong>Web Server (HTTP):</strong> <span style="color: green; font-weight: bold;">Online 🟢</span></p>
        
        <hr style="margin: 20px 0;">
        <p><em>If the database is offline, the catalogue and user authentication systems will fail to load.</em></p>
    </div>
</main>
<script src="js/script.js"></script>
</body>
</html>