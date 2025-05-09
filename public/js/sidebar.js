document.addEventListener('DOMContentLoaded', function() {
    // Target all drawer buttons with more specific selectors
    const sidebarToggleButtons = document.querySelectorAll('.sidebar-toggle-btn, .drawer-btn');
    const sidebar = document.querySelector('.sidebar-wrapper');
    const overlay = document.querySelector('.aside-overlay');
    const layoutWrapper = document.querySelector('.layout-wrapper');

    // Add click event to all toggle buttons
    sidebarToggleButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Toggle sidebar visibility
            if (sidebar) {
                sidebar.classList.toggle('active');
                console.log('Sidebar toggled, active state:', sidebar.classList.contains('active'));
            }

            // Toggle overlay
            if (overlay) {
                overlay.classList.toggle('active');
            }

            // Toggle layout wrapper
            if (layoutWrapper) {
                layoutWrapper.classList.toggle('active');
            }
        });
    });

    // Close sidebar when clicking overlay
    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            if (layoutWrapper) {
                layoutWrapper.classList.remove('active');
            }
        });
    }

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sidebar && sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
            if (overlay) overlay.classList.remove('active');
            if (layoutWrapper) layoutWrapper.classList.remove('active');
        }
    });
}); 