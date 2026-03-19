// js/script.js
// Handles theme switching and mobile menu generation

document.addEventListener('DOMContentLoaded', () => {
    
    // For switching themes
    const themeSelector = document.getElementById('theme-selector');
    const currentTheme = localStorage.getItem('site-theme') || 'light';
    
    document.documentElement.setAttribute('data-theme', currentTheme);
    
    if (themeSelector) {
        themeSelector.value = currentTheme;
        themeSelector.addEventListener('change', function(event) {
            const newTheme = event.target.value;
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('site-theme', newTheme);
        });
    }

    // Hamburger for mobile users
    const nav = document.querySelector('nav');
    const ul = document.querySelector('nav ul');
    
    if (nav && ul) {
        // Creates button using JS
        const menuBtn = document.createElement('button');
        menuBtn.textContent = '☰ Menu';
        menuBtn.className = 'mobile-menu-btn';
        
        // Inserts button before the <ul> list
        nav.insertBefore(menuBtn, ul);
        
        // Listens for clicks to toggle menu open and closed
        menuBtn.addEventListener('click', () => {
            ul.classList.toggle('showing');
        });
    }
});