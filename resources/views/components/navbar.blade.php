<?php

use Livewire\Component;

new class extends Component
{
    public $menus;

    public function mount()
    {
        $this->menus = collect([
            (object)['text' => 'Home', 'link' => '#home'],
            (object)['text' => 'About', 'link' => '#about'],
            (object)['text' => 'Skills', 'link' => '#skills'],
            (object)['text' => 'Projects', 'link' => '#projects'],
        ]);
    }
};
?>

<nav class="max-w-7xl mx-auto bg-white/90 backdrop-blur">
    <div class="flex items-center justify-between h-16 p-5">
        <a href="#" class="text-2xl font-black tracking-tight">
            Portfolio<span class="text-slate-400">.</span>
        </a>

        <div class="hidden md:flex items-center gap-8">
             @foreach ($menus as $menu)
                <a href="{{ $menu->link }}" class="hover:text-slate-600">
                    {{ $menu->text }}
                </a>
            @endforeach
        </div>
        
        <button id="menu-button" class="md:hidden flex flex-col gap-1.5">
            @foreach(range(0,2) as $index)
                <span class="w-6 h-0.5 bg-slate-800"></span>
            @endforeach
        </button>
    </div>

    <div id="mobile-menu" class="w-full absolute top-[65px] z-[100px] border border-md bg-white backdrop-blur shadow-sm hidden md:hidden p-5 flex flex-col gap-4">
        @foreach ($menus as $menu)
            <a href="{{ $menu->link }}" class="mobile-link hover:text-slate-600">
                {{ $menu->text }}
            </a>
        @endforeach
    </div>

    @script
    <script>
        const menuButton = document.getElementById("menu-button");
        const mobileMenu = document.getElementById("mobile-menu");
        const mobileLink = document.querySelectorAll(".mobile-link");
        
        menuButton.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
        
        mobileLink.forEach(link => {
            link.addEventListener("click", () => {
                mobileMenu.classList.add("hidden");
            });
        });

        history.pushState(null, null, '#home');
    </script>
    @endscript
</nav>