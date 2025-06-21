// Simple app.js for traditional Blade views
// No Spark or Inertia dependencies

// Custom JavaScript can be added here
document.addEventListener('DOMContentLoaded', function () {
    console.log('App loaded successfully');

    // Initialize any custom functionality here
    initializeNavigation();
});

function initializeNavigation() {
    // Bootstrap 5 handles the navbar toggle automatically
    // This function can be used for any custom navigation functionality

    // Example: Add active class to current nav item
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    navLinks.forEach((link) => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });
}
