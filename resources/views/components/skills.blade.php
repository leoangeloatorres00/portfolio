<?php

use App\Enums\Icons;
use Livewire\Component;

new class extends Component
{
    public $icons;
    public $navbars;
    public $progressbars;

    public function mount()
    {
        $this->icons = collect([
            (object)['image' => Icons::HTML5, 'text' => 'HTML5', 'category' => 'frontend'],
            (object)['image' => Icons::LARAVEL, 'text' => 'Laravel', 'category' => 'backend'],
            (object)['image' => Icons::REDIS, 'text' => 'Redis', 'category' => 'database'],
            (object)['image' => Icons::REACT, 'text' => 'React', 'category' => 'frontend'],
            (object)['image' => Icons::AWS, 'text' => 'AWS', 'category' => 'devops'],
            (object)['image' => Icons::CSS3, 'text' => 'CSS3', 'category' => 'frontend'],
            (object)['image' => Icons::PHP, 'text' => 'PHP', 'category' => 'backend'],
            (object)['image' => Icons::VUE, 'text' => 'Vue.js', 'category' => 'frontend'],
            (object)['image' => Icons::GITHUB, 'text' => 'Github', 'category' => 'devops'],
            (object)['image' => Icons::MYSQL, 'text' => 'MySQL', 'category' => 'database'],
            (object)['image' => Icons::JAVA, 'text' => 'Java', 'category' => 'backend'],
            (object)['image' => Icons::TAILWINDCSS, 'text' => 'Tailwind CSS', 'category' => 'frontend'],
            (object)['image' => Icons::JAVASCRIPT, 'text' => 'Javascript', 'category' => 'frontend'],
            (object)['image' => Icons::NODEJS, 'text' => 'NodeJS', 'category' => 'backend'],
            (object)['image' => Icons::LIVEWIRE, 'text' => 'Livewire', 'category' => 'frontend'],
        ]);

        $this->progressbars = collect([
            (object)['percentage' => '80%', 'text' => 'Frontend Development'],
            (object)['percentage' => '70%', 'text' => 'Backend Development'],
            (object)['percentage' => '60%', 'text' => 'UI / UX Design'],
            (object)['percentage' => '40%', 'text' => 'DevOps & Deployment'],
        ]);

        $this->navbars = collect([
            (object)['value' => '', 'text' => 'All'],
            (object)['value' => 'frontend', 'text' => 'Frontend'],
            (object)['value' => 'backend', 'text' => 'Backend'],
            (object)['value' => 'database', 'text' => 'Database'],
            (object)['value' => 'devops', 'text' => 'DevOps'],
        ]);
    }
};
?>

<section id="skills" class="py-28 bg-white">
    <div class="max-w-7xl mx-auto px-5">
        <div class="mx-5 lg:mx-10 mb-8">
            <p class="uppercase tracking-[0.3em] text-sm text-slate-400 mb-5">
                Tech Stack
            </p>

            <h1 class="text-4xl md:text-5xl font-black mb-5">
                Skills & Expertise
            </h1>

            <p class="text-gray-400 max-w-2xl leading-relaxed">
                Technologies and tools I use to build scalable,
                responsive, and modern web applications.
            </p>
        </div>

        <div class="mx-5 lg:mx-8 mb-10">
            <div class="inline-flex rounded-xl bg-gray-100 p-1 shadow-sm border">
                @foreach ($navbars as $navbar)
                    <button class="category rounded-lg px-5 py-2 text-sm font-medium text-gray-500 transition-all duration-200" data-category="{{ $navbar->value }}" onclick="handleCategory(this)">
                        {{ $navbar->text }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-10">
            
            <div class="grid grid-cols-5 items-center gap-5">
                @foreach ($icons as $icon)
                    <div title="{{ $icon->text }}" class="icon rounded-3xl text-center transition duration-300 hover:-translate-y-1" data-category="{{ $icon->category }}">
                        <i class="{{ $icon->image }} text-5xl"></i>
                        <p class="text-sm py-2">{{ $icon->text }}</p>
                    </div>
                @endforeach
            </div>
        
            <div class="space-y-10">
                @foreach ($progressbars as $progressbar)
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-medium">{{ $progressbar->text }}</span>
                            <span>{{ $progressbar->percentage }}</span>
                        </div>
                        <div class="h-3 bg-slate-200 rounded-full overflow-hidden">
                            <div 
                                class="skill-progress h-full w-0 bg-slate-900 rounded-full transition-all duration-[1500ms] ease-out"
                                data-width="{{ $progressbar->percentage }}">
                            </div>
                        </div>
                    </div>
                @endforeach                 
            </div>
        </div>
    </div>

    @script
    <script>
        const section = document.querySelector("#skills");
        const icons = document.querySelectorAll(".icon");
        const categories = document.querySelectorAll(".category");
        const progressBars = document.querySelectorAll(".skill-progress");

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    progressBars.forEach((bar) => {
                        bar.style.width = bar.dataset.width;
                    });
                } else {
                    progressBars.forEach((bar) => {
                        bar.style.width = '0%';
                    });
                }

                categories.forEach((element) => {
                    if(!element.dataset.category) {
                        handleCategory(element);
                    } else {
                        buttonSelected(element, false);
                    }
                });
            });
        }, {
            threshold: 0.3
        });

        window.handleCategory = function(navbar) {
            icons.forEach(icon => {
                const isSelected = icon.dataset.category != navbar.dataset.category && navbar.dataset.category != ''
                icon.classList.toggle('opacity-30', isSelected);
                icon.classList.toggle('hover:-translate-y-1', !isSelected);
            });

            categories.forEach((category) => {
                category.classList.remove('bg-black');
                category.classList.remove('text-white');                
            });

            buttonSelected(navbar);
        }

        function buttonSelected(element, isValid = true) {
            element.classList.toggle('bg-black', isValid);
            element.classList.toggle('text-white', isValid);
  
            element.classList.toggle('text-gray-500', !isValid);
        }

        observer.observe(section);
    </script>
    @endscript
</section>

