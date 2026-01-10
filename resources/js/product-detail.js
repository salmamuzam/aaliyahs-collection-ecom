/**
 * Product Detail Page - Image Gallery Slider
 * Handles image switching and navigation for the product gallery
 */

function initProductSlider() {
    const sliderContainer = document.getElementById('product-slider');
    if (!sliderContainer) return;

    const images = JSON.parse(sliderContainer.getAttribute('data-images') || '[]');
    const prev = document.getElementById('prev');
    const next = document.getElementById('next');
    const imageElement = document.getElementById('image');
    const currentSlideText = document.getElementById('current-slide');
    
    let slide = 0;

    if (!imageElement || images.length === 0) return;

    const updateSlider = () => {
        // Step 1: Fade out
        imageElement.style.opacity = '0';
        
        setTimeout(() => {
            // Step 2: Change Source
            imageElement.src = images[slide];
            if (currentSlideText) {
                currentSlideText.innerText = slide + 1;
            }
            // Step 3: Fade in
            imageElement.style.opacity = '1';
        }, 200);
    };

    if (next) {
        next.addEventListener('click', () => {
            slide++;
            if (slide === images.length) {
                slide = 0;
            }
            updateSlider();
        });
    }

    if (prev) {
        prev.addEventListener('click', () => {
            slide--;
            if (slide < 0) {
                slide = images.length - 1;
            }
            updateSlider();
        });
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', initProductSlider);

// Re-initialize for Livewire navigation/re-renders
document.addEventListener('livewire:navigated', initProductSlider);

// Direct call as well for cases where the script is loaded late
initProductSlider();
