const settingsWrapper = document.getElementById('settingsMenu');
const dropdownSettings = document.getElementById('dropdownSettings');

// Check if the device supports hover
const canHover = window.matchMedia('(hover: hover)').matches;

// Open menu on hover for devices that support it
function openMenu() {
    dropdownSettings.classList.remove('hidden');
}

// Close menu on mouse leave or when clicking outside
function closeMenu() {
    dropdownSettings.classList.add('hidden');
}

// Toggle menu for touch devices
function toggleMenu(e) {
    e.preventDefault();
    e.stopPropagation();
    dropdownSettings.classList.toggle('hidden');
}

// Add event listeners based on hover capability
if (canHover) {
    settingsWrapper.addEventListener('mouseenter', openMenu);
    settingsWrapper.addEventListener('mouseleave', closeMenu);
} else {
    settingsWrapper.addEventListener('click', toggleMenu);

    // Close the menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!settingsWrapper.contains(e.target)) {
            closeMenu();
        }
    });
}

// Prevent clicks inside the dropdown from closing the menu
dropdownSettings.addEventListener('click', (e) => {
    e.stopPropagation(); 
});