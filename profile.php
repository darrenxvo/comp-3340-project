<?php
// profile.php
// Handles displaying and updating individual user profile data
session_start();
require_once 'includes/db.php';

// If user isn't logged in, redirect them to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = '';

// Handles the form if the user updates their email address
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $new_email = trim($_POST['email']);
    
    // Statement to prevent SQL injection
    $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
    if ($stmt->execute([$new_email, $user_id])) {
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile. Please try again.";
    }
}

// Fetches user's current data to display on page
$stmt = $pdo->prepare("SELECT username, email, role FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$page_title = "My Profile | Sound Stage";
include 'includes/header.php'; 
?>

<main style="padding: 40px; max-width: 500px; margin: 0 auto;">
    <div class="product-card" style="text-align: left;">
        <h2>Account Details</h2>
        
        <?php if ($message): ?>
            <p style="color: green; font-weight: bold;"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
        <p><strong>Account Privilege:</strong> <?= ucfirst(htmlspecialchars($user['role'])) ?></p>

        <hr style="margin: 20px 0; border: 1px solid var(--card-border);">

        <h3>Update Information</h3>
        <form action="profile.php" method="POST">
            <label for="email">Email Address:</label><br>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required style="width: 100%; margin-bottom: 15px; padding: 8px;">
            <button type="submit" name="update_profile" style="width: 100%;">Save Changes</button>
        </form>
    </div>
</main>

<script src="js/script.js"></script>
</body>
</html>