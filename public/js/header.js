if(!document.cookie.includes('theme=')) {
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    fetch('/theme/' + (prefersDark ? 'dark' : 'light'), {
        credentials: 'same-origin',
    });
}

const settingsWrapper = document.getElementById('settingsMenu');
const dropdownSettings = document.getElementById('dropdownSettings');

const canHover = window.matchMedia('(hover: hover)').matches;

function openMenu() {
    dropdownSettings.classList.remove('hidden');
}

function closeMenu() {
    dropdownSettings.classList.add('hidden');
}

function toggleMenu(e) {
    e.preventDefault();
    e.stopPropagation();
    dropdownSettings.classList.toggle('hidden');
}

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