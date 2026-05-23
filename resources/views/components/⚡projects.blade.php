<?php

use Livewire\Component;

new class extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = collect([
            (object)['image' => 'devicon-html5-plain colored', 'text' => 'HTML5'],
            (object)['image' => 'devicon-css3-plain colored', 'text' => 'CSS3'],
            (object)['image' => 'devicon-javascript-plain colored', 'text' => 'Javascript'],
        ]);
    }
};
?>

<section id="portfolio" class="py-28">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-10">
            <h2 class="text-4xl md:text-5xl font-black mb-5">
                Featured Projects
            </h2>

            <p class="uppercase tracking-[0.3em] text-sm text-slate-400">
                Clean &middot; Responsive &middot; Modern
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-[#FFFFFFB3] rounded-[32px] overflow-hidden transition-all duration-300 ease-in-out hover:-translate-y-[6px] flex flex-col justify-between">
                <div>
                    <img src="{{ asset('images/gcash.png') }}" class="h-64 w-full object-cover" />

                    <div class="p-6 pb-0">
                        <h3 class="text-2xl font-bold mb-3">
                            GCash | eC-Savings
                        </h3>

                        <p class="text-xs text-slate-600 text-justify mb-6">
                            eC-Savings is a digital savings account powered by Cebuana Lhuillier Rural Bank. It features a competitive annual interest rate, no maintaining balance, and can be easily opened and managed entirely through the GCash app (via GSave) or the dedicated eCebuana App
                        </p>
                    </div>
                </div>

                <div class="p-6 pt-0 flex justify-between">
                    <div class="text-xl">
                        <i class="devicon-html5-plain colored"></i> 
                        <i class="devicon-css3-plain colored"></i> 
                        <i class="devicon-javascript-plain colored"></i> 
                        <i class="devicon-vuejs-plain colored"></i> 
                    </div>
                    <div class="text-2xl">
                        <i title="View Project Images" class="fa-solid fa-images" data-project="ecsavings" data-count="6" onclick="openCarousel(0, this)"></i>
                    </div>
                </div>
            </div>
            <div class="bg-[#FFFFFFB3] rounded-[32px] overflow-hidden transition-all duration-300 ease-in-out hover:-translate-y-[6px] flex flex-col justify-between">
                <div>
                    <img src="{{ asset('images/coming_soon2.png') }}" class="h-64 w-full object-cover" />

                    <div class="p-6 pb-0">
                        <h3 class="text-2xl font-bold mb-3">
                            TheBox
                        </h3>

                        <p class="text-xs text-slate-600 text-justify mb-6">
                           TheBox is a sleek streaming platform inspired by Netflix, offering movies and series in a simple, fast, and user-friendly interface for seamless entertainment that focus on simplicity, speed, and accessibility across devices
                        </p>
                    </div>
                </div>

                <div class="p-6 pt-0 flex justify-between">
                    <div class="text-xl">
                        <i class="devicon-html5-plain colored"></i> 
                        <i class="devicon-css3-plain colored"></i> 
                        <i class="devicon-javascript-plain colored"></i> 
                        <i class="devicon-react-plain colored"></i>
                        <i class="devicon-laravel-plain colored"></i>
                        <i class="devicon-mysql-plain colored"></i>
                        <i class="devicon-redis-plain colored"></i>
                    </div>
                    <div class="text-2xl">
                        <i title="View Project Images" class="fa-solid fa-images" data-project="thebox" data-count="3" onclick="openCarousel(0, this)"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>