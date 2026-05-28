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
                'images' => 'images/gcash.png',
                'icons' => [
                    Icons::HTML5, Icons::CSS3, Icons::JAVASCRIPT, Icons::VUE, 
                ],
                'code' => 'ecsavings',
                'galleryCount' => 6
            ],
            (object)[
                'title' => 'TheBox',
                'description' => 'TheBox is a sleek streaming platform inspired by Netflix, offering movies and series in a simple, fast, and user-friendly interface for seamless entertainment that focus on simplicity, speed, and accessibility across devices',
                'images' => 'images/coming_soon2.png',
                'icons' => [
                    Icons::HTML5, Icons::CSS3, Icons::JAVASCRIPT, Icons::REACT, Icons::LARAVEL, Icons::MYSQL, Icons::REDIS
                ],
                'code' => 'thebox',
                'galleryCount' => 3
            ],
        ]);
    }
};
?>

<section id="projects">
    <div class="max-w-7xl mx-auto text-center px-8 lg:px-20 py-[100px]">
        <div class="mb-8">
            <h2 class="text-4xl md:text-5xl font-black mb-5">
                Featured Projects
            </h2>
            
            <p class="uppercase tracking-[0.3em] text-sm text-slate-400">
                Clean &middot; Responsive &middot; Modern
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($projects as $project)
                <div class="card opacity-0 translate-y-16 bg-[#FFFFFFB3] rounded-[32px] overflow-hidden transition-all ease-in-out hover:-translate-y-[8px] flex flex-col justify-between">
                    <div>
                        <img src="{{ asset($project->images) }}" class="h-64 w-full object-cover" />

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
        const section = document.querySelector("#projects");
        const card = document.querySelectorAll(".card");

        if(window.outerWidth < 769) {
            projects.style.height = 100+"%";
        } else {
            projects.style.height = (window.outerHeight)+"px";
        }

        window.addEventListener("resize", (event) => { 
            if(event.target.innerWidth < 769) {
                projects.style.height = 100+"%";
            } else {
                projects.style.height = (window.outerHeight)+"px";
            }
        });
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                card.forEach((element, index) => {
                    element.classList.toggle('opacity-0', !entry.isIntersecting);
                    element.classList.toggle('translate-y-16', !entry.isIntersecting);
                    element.classList.toggle('opacity-100', entry.isIntersecting);
                    element.classList.toggle('translate-y-0', entry.isIntersecting);
                    
                    const duration = 1000 + (index * 1000);
                    element.classList.toggle(`duration-[${duration}ms]`, entry.isIntersecting);
                    
                    setTimeout(() => {
                        const durationClasses = Array.from(element.classList).filter(className => className.includes('duration'));
                        
                        if (durationClasses.length > 0) {
                            element.classList.remove(...durationClasses);
                        }

                        element.classList.toggle('duration-300', entry.isIntersecting);
                    }, 1000);
                   
                });
            });
        }, {
            threshold: 0.3
        });

        observer.observe(section);
    </script>
    @endscript
</section>