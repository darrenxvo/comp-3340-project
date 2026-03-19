<?php
// help-media.php
// Wiki page explaining how to manage multimedia and interactive map features.
$page_title = "Manage Media | Wiki";
include 'includes/header.php'; 
?>

<main style="padding: 40px; max-width: 800px; margin: 0 auto; background-color: var(--card-bg); border-radius: 8px; margin-top: 20px;">
    <h2>Managing Multimedia & Interactive Maps</h2>
    
    <h3>1. Updating the Audio Files</h3>
    <p>Our "About" page features high-fidelity FLAC audio snippets. To swap these out:</p>
    <ul>
        <li>Upload your new audio files (e.g., <code>.flac</code>, <code>.mp3</code>) to the <code>media/</code> directory on the server.</li>
        <li>Open <code>about.php</code> in a text editor.</li>
        <li>Locate the <code>&lt;audio&gt;</code> tags and update the <code>src</code> attribute to point to your new file name.</li>
    </ul>

    <hr style="border: 1px solid var(--card-border); margin: 20px 0;">

    <h3>2. Updating the Interactive Map Location</h3>
    <p>The "Locations" page uses Leaflet.js to render an interactive map. If the physical store moves, you must update the coordinates:</p>
    <ol>
        <li>Open <code>locations.php</code>.</li>
        <li>Find the JavaScript initialization block near the bottom of the file.</li>
        <li>Locate the latitude and longitude coordinates: <code>setView([42.3149, -83.0364])</code> and <code>L.marker([42.3149, -83.0364])</code>.</li>
        <li>Replace those numbers with your new GPS coordinates and save the file.</li>
    </ol>
</main>

<script src="js/script.js"></script>
</body>
</html>