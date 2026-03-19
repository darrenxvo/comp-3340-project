<?php
// about.php
$page_title = "About Us | Sound Stage";
include 'includes/header.php'; 
?>

<main style="padding: 40px; max-width: 800px; margin: 0 auto;">
    <h2>Our Business Case</h2>
    <p>
        Sound Stage is a comprehensive e-commerce platform designed for audiophiles and casual listeners alike. 
        Our diverse music catalogue focuses on providing high-fidelity physical media, specifically catering to the resurgence of Vinyl records 
        and the enduring reliability of standard CDs. By offering a curated selection of critically acclaimed albums across various genres, 
        our goal is to encourage all music fans to continue the tradition of owning physical media instead of digital streaming platforms. 
        Our website supports dynamic browsing, secure user profiles, and administrative inventory management to ensure a seamless shopping experience.
    </p>

    <hr style="margin: 30px 0; border: 1px solid var(--card-border);">

    <h2>Featured Media</h2>
    <p>Check out our promotional media below.</p>

    <div style="margin-bottom: 20px;">
        <h3>Vinyl Sound Quality Snippet 1</h3>
        <audio controls>
            <source src="media/Headlock.flac" type="audio/flac">
            Your browser does not support the audio element.
        </audio>
    </div>

    <div style="margin-bottom: 20px;">
        <h3>Vinyl Sound Quality Snippet 2</h3>
        <audio controls>
            <source src="media/PicturesOfYou.flac" type="audio/flac">
            Your browser does not support the audio element.
        </audio>
    </div>

    <div style="margin-bottom: 20px;">
        <h3>Vinyl Sound Quality Snippet 3</h3>
        <audio controls>
            <source src="media/Outro.flac" type="audio/flac">
            Your browser does not support the audio element.
        </audio>
    </div>

</main>
<script src="js/script.js"></script>
</body>
</html>