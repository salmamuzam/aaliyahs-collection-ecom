let navbarInitialized = false;

function initNavbar() {
    var toggleOpen = document.getElementById("toggleOpen");
    var toggleClose = document.getElementById("toggleClose");
    var collapseMenu = document.getElementById("collapseMenu");

    if (!toggleOpen || !toggleClose || !collapseMenu) {
        return; // Elements not found, exit
    }

    // Only initialize once to avoid duplicate listeners
    if (navbarInitialized) {
        return;
    }

    function handleClick() {
        if (collapseMenu.style.display === "block") {
            collapseMenu.style.display = "none";
        } else {
            collapseMenu.style.display = "block";
        }
    }

    toggleOpen.addEventListener("click", handleClick);
    toggleClose.addEventListener("click", handleClick);
    
    navbarInitialized = true;
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', initNavbar);

// Reinitialize after Livewire navigation
document.addEventListener('livewire:navigated', () => {
    navbarInitialized = false; // Reset flag
    initNavbar();
});
