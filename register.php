<?php
// register.php
session_start();
require_once 'includes/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // Encrypt the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')");
            $stmt->execute([$username, $email, $hashed_password]);
            $success = "Registration successful! You can now log in.";
        } catch (PDOException $e) {
            $error = "That email or username is already registered.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Sound Stage</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Create an Account</h1>
    <nav><ul><li><a href="index.php">Back to Store</a></li></ul></nav>
</header>

<main style="padding: 40px; max-width: 400px; margin: 0 auto; text-align: center;">
    <div class="product-card">
        <?php if ($error): ?><p style="color: red;"><?= $error ?></p><?php endif; ?>
        <?php if ($success): ?><p style="color: green;"><?= $success ?></p><?php endif; ?>
        
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required style="width: 100%; margin-bottom: 15px; padding: 8px;"><br>
            <input type="email" name="email" placeholder="Email Address" required style="width: 100%; margin-bottom: 15px; padding: 8px;"><br>
            <input type="password" name="password" placeholder="Password" required style="width: 100%; margin-bottom: 15px; padding: 8px;"><br>
            <button type="submit" style="width: 100%;">Register</button>
        </form>
        <p style="margin-top: 15px;">Already have an account? <a href="login.php">Log in here</a>.</p>
    </div>
</main>
<script src="js/script.js"></script>
</body>
</html>