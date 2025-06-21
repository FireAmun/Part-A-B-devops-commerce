/* Dark mode utilities */
document.addEventListener('DOMContentLoaded', function() {
    // Check if dark mode toggle exists in the current page
    const darkModeToggle = document.getElementById('dark-mode-toggle');

    if (darkModeToggle) {
        // Check localStorage for dark mode preference
        const darkMode = localStorage.getItem('darkMode');
        const body = document.body;

        // Apply dark mode if it was enabled previously
        if (darkMode === 'enabled') {
            body.classList.add('dark-mode');
            darkModeToggle.classList.add('active');
        }

        // Remove the onclick attribute to prevent double-triggering
        darkModeToggle.removeAttribute('onclick');

        // Set up the dark mode toggle functionality
        darkModeToggle.addEventListener('click', function() {
            toggleDarkMode();
        });
    }
});

// Function to toggle dark mode
function toggleDarkMode() {
    const body = document.body;
    const toggle = document.getElementById('dark-mode-toggle');

    // Force a fresh check from localStorage first
    const currentMode = localStorage.getItem('darkMode');

    if (currentMode === 'enabled') {
        // If it's already enabled, disable it
        body.classList.remove('dark-mode');
        if (toggle) toggle.classList.remove('active');
        localStorage.setItem('darkMode', 'disabled');
    } else {
        // If it's disabled or not set, enable it
        body.classList.add('dark-mode');
        if (toggle) toggle.classList.add('active');
        localStorage.setItem('darkMode', 'enabled');
    }

    console.log('Dark mode toggled. Current state:', localStorage.getItem('darkMode'));
}
