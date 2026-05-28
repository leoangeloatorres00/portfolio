<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>
<nav>
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
        <a href="#" class="text-2xl font-black tracking-tight">
            Portfolio<span class="text-slate-400">.</span>
        </a>

        <nav class="hidden md:flex items-center gap-10 text-md font-medium">
            <a href="#" class="hover:text-slate-500 transition">Home</a>
            <a href="#about" class="hover:text-slate-500 transition">About</a>
            <a href="#skills" class="hover:text-slate-500 transition">Skills</a>
            <a href="#projects" class="hover:text-slate-500 transition">Projects</a>
        </nav>

        <button id="menu-btn" class="md:hidden flex flex-col gap-1.5" onclick="openNavbar()">
            <span class="w-6 h-0.5 bg-black transition-all"></span>
            <span class="w-6 h-0.5 bg-black transition-all"></span>
            <span class="w-6 h-0.5 bg-black transition-all"></span>
        </button>
    </div>

    <div id="mobile-menu" class="absolute top-16 left-0 w-full z-50 max-h-0 overflow-hidden transition-all duration-300 md:hidden bg-white
           backdrop-blur-xl
           border border-white/50
           shadow-2xl
           rounded-2xl"
    >
        <div id="mobile-button" class="flex flex-col px-6 py-4 gap-4">
            <a onclick="openNavbar()"  href="#" class="hover:text-slate-500 transition">Home</a>
            <a onclick="openNavbar()"  href="#about" class="hover:text-slate-500 transition">About</a>
            <a onclick="openNavbar()"  href="#skills" class="hover:text-slate-500 transition">Skills</a>
            <a onclick="openNavbar()"  href="#projects" class="hover:text-slate-500 transition">Projects</a>
        </div>
    </div>

    
    @script
     <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileButton = document.querySelectorAll('#mobile-button a');

        let isOpen = false;

        window.openNavbar = function() {
            isOpen = !isOpen;

            if (isOpen) {
                mobileMenu.classList.remove('max-h-0');
                mobileMenu.classList.add('max-h-96');
            } else {
                mobileMenu.classList.remove('max-h-96');
                mobileMenu.classList.add('max-h-0');
            }
        }
    </script>
    @endscript
</nav>