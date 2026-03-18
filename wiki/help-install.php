<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Installation | Wiki</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<header><h1>Developer Installation Guide</h1><nav><ul><li><a href="help-index.php">Back</a></li></ul></nav></header>
<main style="padding: 40px; max-width: 800px; margin: 0 auto;">
    <h2>Deploying the Application</h2>
    <p>To install this application on a new server (e.g., UWindsor myweb):</p>
    <ol>
        <li>Clone the repository from GitHub to your local machine.</li>
        <li>Upload all files via FTP to your public web directory (e.g., `public_html`).</li>
        <li>Create a new MySQL database on your host.</li>
        <li>Import the provided SQL schema via phpMyAdmin to build the `products` and `users` tables.</li>
        <li>Update `includes/db.php` with your new database host, name, username, and password.</li>
    </ol>
</main>
</body>
</html>