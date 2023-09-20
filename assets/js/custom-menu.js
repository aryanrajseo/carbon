document.addEventListener('DOMContentLoaded', function () {
    const mobileNavToggle = document.getElementById('carbon-mobile-nav-primary');
    const navPrimary = document.getElementById('carbon-nav-primary');
    const closeButton = document.getElementById('close-button');

    // Function to open the menu
    function openMenu() {
        mobileNavToggle.setAttribute('aria-expanded', 'true');
        navPrimary.classList.add('open');
        document.body.classList.add('menu-active'); // Add the class to the body
        document.body.style.overflow = 'hidden'; // Hide overflow
        // Set focus on the first menu item
        const firstMenuItem = navPrimary.querySelector('a');
        if (firstMenuItem) {
            firstMenuItem.focus();
        }
    }

    // Function to close the menu
    function closeMenu() {
        mobileNavToggle.setAttribute('aria-expanded', 'false');
        navPrimary.classList.remove('open');
        document.body.classList.remove('menu-active'); // Remove the class from the body
        document.body.style.overflow = 'auto'; // Restore overflow
        mobileNavToggle.focus(); // Set focus back on the button
    }

    // Handle clicks on the mobileNavToggle button to toggle the menu
    mobileNavToggle.addEventListener('click', () => {
        const isExpanded = mobileNavToggle.getAttribute('aria-expanded') === 'true';
        if (isExpanded) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    // Handle clicks on the closeButton to close the menu
    closeButton.addEventListener('click', closeMenu);

    // Handle key presses for accessibility
    mobileNavToggle.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === 'Space') {
            event.preventDefault();
            toggleMenu();
        }
    });

    // Prevent clicks outside of the menu from closing it
    mobileNavToggle.addEventListener('click', (event) => {
        event.stopPropagation();
    });

    // Close the menu when the user presses the "Escape" key
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && navPrimary.classList.contains('open')) {
            closeMenu();
        }
    });
});
