<?php

use App\Enums\Icons;
use App\Enums\Links;
use Livewire\Component;

new class extends Component
{
    public $icons;
    public $navbars;
    public $progressbars;

    public function mount()
    {
        $this->icons = collect([
            (object)['link' => Links::HTML5, 'image' => Icons::HTML5, 'text' => 'HTML5', 'category' => 'frontend'],
            (object)['link' => Links::LARAVEL, 'image' => Icons::LARAVEL, 'text' => 'Laravel', 'category' => 'backend'],
            (object)['link' => Links::REDIS, 'image' => Icons::REDIS, 'text' => 'Redis', 'category' => 'database'],
            (object)['link' => Links::REACT, 'image' => Icons::REACT, 'text' => 'React', 'category' => 'frontend'],
            (object)['link' => Links::AWS, 'image' => Icons::AWS, 'text' => 'AWS', 'category' => 'devops'],
            (object)['link' => Links::CSS3, 'image' => Icons::CSS3, 'text' => 'CSS3', 'category' => 'frontend'],
            (object)['link' => Links::PHP, 'image' => Icons::PHP, 'text' => 'PHP', 'category' => 'backend'],
            (object)['link' => Links::VUE, 'image' => Icons::VUE, 'text' => 'Vue.js', 'category' => 'frontend'],
            (object)['link' => Links::GITHUB, 'image' => Icons::GITHUB, 'text' => 'Github', 'category' => 'devops'],
            (object)['link' => Links::MYSQL, 'image' => Icons::MYSQL, 'text' => 'MySQL', 'category' => 'database'],
            (object)['link' => Links::JAVA, 'image' => Icons::JAVA, 'text' => 'Java', 'category' => 'backend'],
            (object)['link' => Links::TAILWINDCSS, 'image' => Icons::TAILWINDCSS, 'text' => 'Tailwind CSS', 'category' => 'frontend'],
            (object)['link' => Links::JAVASCRIPT, 'image' => Icons::JAVASCRIPT, 'text' => 'Javascript', 'category' => 'frontend'],
            (object)['link' => Links::NODEJS, 'image' => Icons::NODEJS, 'text' => 'NodeJS', 'category' => 'backend'],
            (object)['link' => Links::LIVEWIRE, 'image' => Icons::LIVEWIRE, 'text' => 'Livewire', 'category' => 'frontend'],
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

<section id="skills"
    class="min-h-[calc(100vh-64px)] flex items-center justify-center md:justify-start text-center md:text-left bg-white">
    <div class="max-w-7xl mx-auto w-full p-5">
        <div class="space-y-5 mb-5">
            <p class="uppercase tracking-[0.3em] text-xs md:text-sm text-slate-800">
                Tech Stack
            </p>

            <h1 class="text-3xl md:text-4xl font-black">
                Skills & Expertise
            </h1>

            <p class="text-sm md:text-base text-gray-800 max-w-2xl leading-relaxed">
                Technologies and tools I use to build scalable,
                responsive, and modern web applications.
            </p>
        </div>

        <div class="inline-flex rounded-xl justify-center bg-gray-100 p-1 shadow-sm  mb-8">
            @foreach ($navbars as $navbar)
                <button class="category-button rounded-lg px-3 py-2 text-[10px] sm:text-xs font-medium"
                    onclick="handleCategory({{ $loop->index }})">
                    {{ $navbar->text }}
                </button>
            @endforeach
        </div>

        <div class="grid md:grid-cols-2 gap-10">
            <div class="grid grid-cols-5 items-center gap-5">
                @foreach ($icons as $icon)
                    <a href="{{ $icon->link }}" class="icon rounded-3xl text-center" data-category="{{ $icon->category }}">
                        <i class="{{ $icon->image }} text-4xl md:text-5xl"></i>
                        <p class="text-xs py-2">{{ $icon->text }}</p>
                    </a>
                @endforeach
            </div>

            <div class="space-y-10">
                @foreach ($progressbars as $progressbar)
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-medium">{{ $progressbar->text }}</span>
                            <span>{{ $progressbar->percentage }}</span>
                        </div>
                        <div class="h-3 bg-slate-200 rounded-full overflow-hidden mb-8">
                            <div class="skill-progress h-full w-0 bg-slate-900 rounded-full transition-all duration-[1500ms] ease-out"
                                data-width="{{ $progressbar->percentage }}" />
                        </div>
                    </div> 
                @endforeach
            </div>
        </div>
    </div>

    @script
    <script>
        const skills = document.getElementById('skills');

        const icons = document.querySelectorAll(".icon");
        const progressBars = document.querySelectorAll(".skill-progress");
        const categoryButton = document.querySelectorAll(".category-button");

        window.handleCategory = (index) => {
            categoryIconSelected(index);
            categoryButtonSelected(index);
        }

        function categoryButtonSelected(index) {
            categoryButton.forEach((element, elementIndex) => {
                const isSelected = index === elementIndex;
                element.classList.toggle('bg-black', isSelected);
                element.classList.toggle('text-white', isSelected);
            });
        }

        function categoryIconSelected(index) {
            const category = ['', 'frontend', 'backend', 'database', 'devops'];

            icons.forEach((element) => {
                const isSelected = element.dataset.category != category[index] && category[index] != ''
                element.classList.toggle('opacity-30', isSelected);
                element.classList.toggle('hover:-translate-y-1', !isSelected);
            });
        }

        const observer = new IntersectionObserver((entries) => {
            const self = this
            entries.forEach((entry) => {
                progressBars.forEach((element) => {
                    element.style.width = entry.isIntersecting ? element.dataset.width : '0%';
                });

                handleCategory(0);
            });
        }, {
            threshold: 0.3
        });

        observer.observe(skills);
    </script>
    @endscript
</section>