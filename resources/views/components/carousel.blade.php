<?php

use Livewire\Component;

new class extends Component
{
  // 
};
?>

<div id="carouselModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <!-- Close -->
    <button onclick="closeCarousel()" class="absolute top-5 right-5 text-white text-3xl">
        &times;
    </button>

    <!-- Prev -->
    <button onclick="prevImage()" class="absolute left-5 text-white text-4xl">
        &#10094;
    </button>
    
    <!-- Image -->
    <img id="modalImg" class="max-w-[90%] max-h-[80vh] rounded-2xl shadow-lg" />
    
    <!-- Next -->
    <button onclick="nextImage()" class="absolute right-5 text-white text-4xl">
        &#10095;
    </button>

    @script
    <script>
        let images = [];

        let current = 0;

        const modal = document.getElementById("carouselModal");
        const img = document.getElementById("modalImg");

        window.openCarousel = function(index, self) {
        loadImage(self);

        current = index;
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        
        updateImage();
        }

        window.closeCarousel = function() {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
        }

        window.nextImage = function() {
        current = (current + 1) % images.length;
        updateImage();
        }

        window.prevImage = function() {
        current = (current - 1 + images.length) % images.length;
        updateImage();
        }

        function loadImage(self) {
        images = [];
        Array.from({ length: self.dataset.count }).forEach((_, i) => {
            images.push(`./images/${self.dataset.project}/image${i+1}.jpg`);
        });

        console.log(images)
        }

        function updateImage() {
        img.src = images[current];
        }

        // click outside to close
        modal.addEventListener("click", (e) => {
        if (e.target === modal) window.closeCarousel();
        });
    </script>
    @endscript
</div>
