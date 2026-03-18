<?php
// login.php
session_start();
require_once 'includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verify if the user exists and password matches
    if ($user && password_verify($password, $user['password'])) {
        // Checks if admin disabled the account
        if ($user['status'] === 'disabled') {
            $error = "This account has been disabled by an administrator.";
        } else {
            // Logs user in by storing their data in the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Will be 'user' or 'admin'
            
            header("Location: index.php"); // Sends them back to homepage
            exit;
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Sound Stage</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Welcome Back</h1>
    <nav><ul><li><a href="index.php">Back to Store</a></li></ul></nav>
</header>

<main style="padding: 40px; max-width: 400px; margin: 0 auto; text-align: center;">
    <div class="product-card">
        <?php if ($error): ?><p style="color: red;"><?= $error ?></p><?php endif; ?>
        
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email Address" required style="width: 100%; margin-bottom: 15px; padding: 8px;"><br>
            <input type="password" name="password" placeholder="Password" required style="width: 100%; margin-bottom: 15px; padding: 8px;"><br>
            <button type="submit" style="width: 100%;">Log In</button>
        </form>
        <p style="margin-top: 15px;">Need an account? <a href="register.php">Register here</a>.</p>
    </div>
</main>
<script src="js/script.js"></script>
</body>
</html>