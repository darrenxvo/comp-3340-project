<?php
// locations.php
// Displays a map for the store location
session_start();
require_once 'includes/db.php';

$page_title = "Our Location | Sound Stage";
include 'includes/header.php'; 
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<main style="padding: 40px; max-width: 800px; margin: 0 auto; text-align: center;">
    <h2>Visit Sound Stage</h2>
    <p>Come browse our extensive catalogue of all the best records on site!</p>
    
    <div id="store-map" style="height: 450px; width: 100%; border-radius: 8px; border: 2px solid var(--card-border); margin-top: 20px; z-index: 1;"></div>

    <script>
        // Initialize the interactive map using Leaflet.js
        document.addEventListener('DOMContentLoaded', function() {
            // Creates the map object and sets coordinates to Windsor, Ontario
            var map = L.map('store-map').setView([42.3149, -83.0364], 13);

            // Load the map tile layer from OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Interactive marker
            var marker = L.marker([42.3149, -83.0364]).addTo(map);
            
            // Clickable popup to the marker
            marker.bindPopup("<b>Sound Stage Records</b><br>Downtown Windsor.").openPopup();
        });
    </script>
</main>

<script src="js/script.js"></script>
</body>
</html>