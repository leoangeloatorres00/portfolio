<?php
use App\Enums\Icons;
use Livewire\Component;

new class extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = collect([
            (object)[
                'title' => ' GCash | eC-Savings',
                'description' => 'eC-Savings is a digital savings account powered by Cebuana Lhuillier Rural Bank. It features a competitive annual interest rate, no maintaining balance, and can be easily opened and managed entirely through the GCash app (via GSave) or the dedicated eCebuana App',
                'images' => 'images/gcash.webp',
                'icons' => [
                    Icons::HTML5, Icons::CSS3, Icons::JAVASCRIPT, Icons::VUE, 
                ],
                'code' => 'ecsavings',
                'galleryCount' => 6
            ],
            (object)[
                'title' => 'TheBox',
                'description' => 'TheBox is a sleek streaming platform inspired by Netflix, offering movies and series in a simple, fast, and user-friendly interface for seamless entertainment that focus on simplicity, speed, and accessibility across devices',
                'images' => 'images/coming_soon2.webp',
                'icons' => [
                    Icons::HTML5, Icons::CSS3, Icons::JAVASCRIPT, Icons::REACT, Icons::LARAVEL, Icons::MYSQL, Icons::REDIS
                ],
                'code' => 'thebox',
                'galleryCount' => 1
            ],
        ]);
    }
};
?>

<section id="projects" class="min-h-screen flex items-center justify-center text-center">
    <div class="max-7-xl w-full p-5">
        <h2 class="text-3xl md:text-4xl font-black mb-5">
            Featured Projects
        </h2>
        <p class="uppercase tracking-[0.3em] text-sm md:text-base text-slate-800">
            Clean &middot; Responsive &middot; Modern
        </p>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10 py-10">
            @foreach ($projects as $project)    
                <div class="project-card bg-[#FFFFFFB3] rounded-[32px] overflow-hidden flex flex-col justify-between border border-gray-400 transition-transform duration-300 hover:-translate-y-[8px]" style="--i:{{ $loop->index+1 }}">
                    <div>
                        <img src="{{ asset($project->images) }}"
                            class="h-64 w-full object-cover" loading="lazy" alt="Project Images"/>
                        <div class="p-6 pb-0">
                            <h3 class="text-2xl font-bold mb-3">
                                {{ $project->title }}
                            </h3>
                            <p class="text-xs text-slate-600 text-justify mb-6">
                                {{ $project->description }}
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0 flex justify-between">
                        <div class="text-xl">
                            @foreach ( $project->icons as $icon)
                                <i class="{{ $icon }}"></i> 
                            @endforeach
                        </div>
                        <div class="text-2xl">
                            <i title="View Project Images" class="fa-solid fa-images" data-project="{{ $project->code }}" data-count="{{ $project->galleryCount }}" onclick="openCarousel(0, this)"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    @script
    <script>
        const projects = document.getElementById('projects');
        const projectCard = document.querySelectorAll(".project-card");

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                projectCard.forEach((element, index) => {
                    element.classList.toggle('fade-up', entry.isIntersecting);
                    element.classList.toggle('fade-item', entry.isIntersecting);
                    element.classList.toggle('fade-delay-staggared', entry.isIntersecting);
                    
                    setTimeout(() => {
                        element.classList.remove('fade-up', entry.isIntersecting);
                        element.classList.remove('fade-item', entry.isIntersecting);
                        element.classList.remove('fade-delay-staggared', entry.isIntersecting);
                    }, 1000);
                });
            });
        }, {
            threshold: 0.3
        });

        observer.observe(projects);
    </script>
    @endscript
</section>