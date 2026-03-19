<?php
$page_title = "Installation | Wiki";
include 'includes/header.php';
?>
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
<script src="js/script.js"></script>
</body>
</html>