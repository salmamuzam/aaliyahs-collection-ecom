/**
 * Product Detail Page - Image Gallery
 * Handles thumbnail image switching for the product gallery
 */

window.changeImage = function(src, element) {
    // Update main image
    document.getElementById('mainImage').src = src;
}

window.updateDots = function(element) {
     // Remove active state from all dots
    const dots = element.parentElement.children;
    for (let dot of dots) {
        dot.classList.remove('bg-brand-burgundy', 'scale-110');
        dot.classList.add('bg-brand-teal');
    }
    
    // Add active state to clicked dot
    element.classList.remove('bg-brand-teal');
    element.classList.add('bg-brand-burgundy', 'scale-110');
}
