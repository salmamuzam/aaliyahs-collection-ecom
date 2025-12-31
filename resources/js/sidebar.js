document.addEventListener("livewire:navigated", function () {
    const sidebar = document.getElementById("sidebar");
    const hamburger = document.getElementById("hamburger");
    const overlay = document.getElementById("sidebar-overlay");
    const hamburgerIcon = hamburger.querySelector("svg");

    // Toggle sidebar
    function toggleSidebar() {
        const isOpen = sidebar.classList.toggle("-translate-x-full");
        overlay.classList.toggle("hidden");

        // Toggle icon between hamburger and close
        if (!isOpen) {
            // Sidebar is open - show close icon (X)
            hamburgerIcon.innerHTML =
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
        } else {
            // Sidebar is closed - show hamburger icon
            hamburgerIcon.innerHTML =
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
        }
    }

    // Open/close sidebar
    hamburger.addEventListener("click", toggleSidebar);
    overlay.addEventListener("click", toggleSidebar);

    // Close sidebar when clicking a link (optional, for better UX)
    const sidebarLinks = sidebar.querySelectorAll("a");
    sidebarLinks.forEach((link) => {
        link.addEventListener("click", function () {
            if (window.innerWidth < 1024) {
                // Only on mobile
                toggleSidebar();
            }
        });
    });
});
