<?php

use Livewire\Component;

new class extends Component
{
    public $icons;

    public function mount()
    {
        $this->icons = collect([
            (object)['image' => 'devicon-html5-plain colored', 'text' => 'HTML5'],
            (object)['image' => 'devicon-javascript-plain colored', 'text' => 'Javascript'],
            (object)['image' => 'devicon-css3-plain colored', 'text' => 'CSS3'],
            (object)['image' => 'devicon-laravel-plain colored', 'text' => 'Laravel'],
            (object)['image' => 'devicon-livewire-plain colored', 'text' => 'Livewire'],
            (object)['image' => 'devicon-tailwindcss-plain colored', 'text' => 'Tailwind CSS'],
        ]);
    }
};
?>

<section id="home" class="flex items-center justify-center text-center bg-white">
    <div class="max-w-5xl mx-auto px-6 py-32">
        <p class="uppercase tracking-[0.3em] text-sm text-slate-400 mb-6">
            Web Developer • Software Engineer
        </p>

        <h1 class="text-5xl md:text-6xl font-black leading-tight mb-8">
            Leo Angelo Torres
        </h1>

        <p class="text-md md:text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto mb-8">
            Experienced web developer focused on creating
            responsive, scalable, and modern web applications
            with clean UI and efficient backend architecture.
        </p>

        <div class="flex justify-center gap-5 mb-10">
            @foreach ($icons as $icon)
                <i title="{{ $icon->text }}" class="{{ $icon->image }} text-4xl md:text-5xl transition duration-300 hover:-translate-y-1"></i>                
            @endforeach
        </div>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="/docs/resume.pdf" download="Torres Leo Angelo.pdf" class="bg-slate-900 text-white px-6 md:px-8 py-4 rounded-full font-medium hover:opacity-90 transition">
                Download CV
            </a>

            <button onclick="openModal()" class="border border-slate-300 px-6 md:px-8 py-4 rounded-full font-medium hover:bg-[#f8fafc] transition">
                Contact Me
            </button>
        </div>
    </div>
</section>