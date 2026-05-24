<?php

use Livewire\Component;

new class extends Component
{
    public $icons;
    public $progressbars;

    public function mount()
    {
        $this->icons = collect([
            (object)['image' => 'devicon-html5-plain colored', 'text' => 'HTML5'],
            (object)['image' => 'devicon-css3-plain colored', 'text' => 'CSS3'],
            (object)['image' => 'devicon-javascript-plain colored', 'text' => 'Javascript'],
            (object)['image' => 'devicon-tailwindcss-plain colored', 'text' => 'Tailwind CSS'],
            (object)['image' => 'devicon-vuejs-plain colored', 'text' => 'Vue.js'],
            (object)['image' => 'devicon-react-plain colored', 'text' => 'React'],
            (object)['image' => 'devicon-php-plain colored', 'text' => 'PHP'],
            (object)['image' => 'devicon-laravel-plain colored', 'text' => 'Laravel'],
            
            (object)['image' => 'devicon-java-plain colored', 'text' => 'Java'],
            (object)['image' => 'devicon-mysql-plain colored', 'text' => 'MySQL'],
            (object)['image' => 'devicon-github-plain colored', 'text' => 'Github'],
            (object)['image' => 'devicon-amazonwebservices-plain-wordmark colored', 'text' => 'AWS'],
        ]);

        $this->progressbars = collect([
            (object)['percentage' => '100%', 'text' => 'Frontend Development'],
            (object)['percentage' => '90%', 'text' => 'Backend Development'],
            (object)['percentage' => '80%', 'text' => 'UI / UX Design'],
            (object)['percentage' => '70%', 'text' => 'DevOps & Deployment'],
        ]);
    }
};
?>

<section id="skills" class="py-28 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mx-5 lg:mx-10 mb-20">
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

        <div class="grid lg:grid-cols-2 gap-20">
            <div class="grid grid-cols-4 items-center gap-5">
                @foreach ($icons as $icon)
                    <div title="{{ $icon->text }}" class="icon rounded-3xl text-center transition duration-300 hover:-translate-y-1">
                        <i class="{{ $icon->image }} text-6xl"></i>
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
</section>

@script
<script>
    const section = document.querySelector("#skills");
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
        });
    }, {
        threshold: 0.3
    });

    observer.observe(section);
</script>
@endscript