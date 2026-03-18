// js/script.js
// This if for dynamic theme switching and then saves user's preference to localStorage

document.addEventListener('DOMContentLoaded', () => {
    const themeSelector = document.getElementById('theme-selector');
    
    // Checks if user already saved a theme preference
    const currentTheme = localStorage.getItem('site-theme') || 'light';
    
    // Applies that theme to the whole document
    document.documentElement.setAttribute('data-theme', currentTheme);
    
    // Updates dropdown menu to show correct current theme
    if (themeSelector) {
        themeSelector.value = currentTheme;
        
        // Listening for when user selects a new theme
        themeSelector.addEventListener('change', function(event) {
            const newTheme = event.target.value;
            
            // Applies new theme
            document.documentElement.setAttribute('data-theme', newTheme);
            
            // Saves to localStorage to remember for the future
            localStorage.setItem('site-theme', newTheme);
        });
    }
});