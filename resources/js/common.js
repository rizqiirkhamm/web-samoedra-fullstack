// Theme toggle functionality
function initThemeToggle() {
    const themeToggleBtn = document.getElementById('theme-toggle');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', isDark);
        });
    }
}

// Profile dropdown functionality
window.profileAction = function() {
    const profileDropdown = document.querySelector('.profile-dropdown');
    if (profileDropdown) {
        profileDropdown.classList.toggle('hidden');

        if (!profileDropdown.classList.contains('hidden')) {
            setTimeout(() => {
                document.addEventListener('click', function closeMenu(e) {
                    if (!profileDropdown.contains(e.target) &&
                        !e.target.closest('[onclick="profileAction()"]')) {
                        profileDropdown.classList.add('hidden');
                        document.removeEventListener('click', closeMenu);
                    }
                });
            }, 100);
        }
    }
}

// Initialize all common functionalities
document.addEventListener('DOMContentLoaded', function() {
    initThemeToggle();

    const profileDropdown = document.querySelector('.profile-dropdown');
    if (profileDropdown) {
        profileDropdown.classList.add('hidden');
    }
});