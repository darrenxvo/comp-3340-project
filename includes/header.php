<?php
// includes/header.php
// This is a header for SEO meta tags, database connection, and dynamic navigation

// Start the session only if one hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connects to the database
require_once __DIR__ . '/db.php'; 

// SEO variables (we default to these if they're not set on a specific page)
$seo_title = isset($page_title) ? $page_title : "Sound Stage | Shop Vinyl & CDs";
$seo_desc = isset($meta_desc) ? $meta_desc : "A curated selection of the best albums on Vinyl and CD.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= htmlspecialchars($seo_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($seo_desc) ?>">
    <meta name="keywords" content="music, vinyl, cd, albums, sound stage, record store, turntable">
    
    <link rel="icon" href="images/favicon.png" type="image/png">
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Sound Stage</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="locations.php">Locations</a></li> 
            <li><a href="quote-calculator.php">Custom Quote</a></li>
            <li><a href="help-index.php">Help</a></li>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="logout.php">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a></li>
                
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <li><a href="admin.php" class="admin-link">Admin Dashboard</a></li>
                    <li><a href="monitor.php" class="admin-link">Server Monitor</a></li>
                <?php endif; ?>
                
            <?php else: ?>
                <li><a href="login.php">Login / Register</a></li>
            <?php endif; ?>
        </ul>
        
        <select id="theme-selector">
            <option value="light">Cyberpunk Theme</option>
            <option value="dark">Comic Book Theme</option>
            <option value="retro">Moody Theme</option>
        </select>
    </nav>
</header>