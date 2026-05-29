<?php

use Livewire\Component;

new class extends Component
{
  // 
};
?>

<div id="gallery" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-50">
    <button onclick="closeCarousel()" class="absolute top-5 right-5 text-white text-3xl" id="carousel-button-close">
        &times;
    </button>

    <button onclick="prevImage()" class="absolute left-5 text-white text-4xl">
        &#10094;
    </button>

    <img id="carousel-image" class="max-w-[90%] max-h-[80vh] rounded-2xl shadow-lg" />
    
    <button onclick="nextImage()" class="absolute right-5 text-white text-4xl">
        &#10095;
    </button>

    @script
    <script>
        let images = [];

        let current = 0;

        const carouselImage = document.getElementById("carousel-image");

        const gallery = document.getElementById("gallery");

        window.openCarousel = function (index, self) {
            current = index;

            loadImage(self);

            handleBackdrop(gallery);

            updateImage();
        }

        window.closeCarousel = function () {
            handleBackdrop(gallery);
        }

        window.nextImage = function () {
            current = (current + 1) % images.length;
            updateImage();
        }

        window.prevImage = function () {
            current = (current - 1 + images.length) % images.length;
            updateImage();
        }

        function loadImage(self) {
            images = [];
            Array.from({ length: self.dataset.count }).forEach((_, i) => {
                images.push(`./images/${self.dataset.project}/image${i + 1}.jpg`);
            });
        }

        function updateImage() {
            carouselImage.src = images[current];
        }

        window.addEventListener('click', function (e) {
            if (e.target === gallery) {
                handleBackdrop(gallery);
            }
        });
    </script>
    @endscript
</div>