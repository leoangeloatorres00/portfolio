<?php
use App\Enums\Icons;
use App\Enums\Links;
use Livewire\Component;

new class extends Component
{
    public $icons;

    public function mount()
    {
        $this->icons = collect([
            (object)['link' => Links::HTML5 ,'image' => Icons::HTML5, 'text' => 'HTML5'],
            (object)['link' => Links::JAVASCRIPT ,'image' => Icons::JAVASCRIPT, 'text' => 'Javascript'],
            (object)['link' => Links::CSS3 ,'image' => Icons::CSS3, 'text' => 'CSS3'],
            (object)['link' => Links::LARAVEL ,'image' => Icons::LARAVEL, 'text' => 'Laravel'],
            (object)['link' => Links::LIVEWIRE ,'image' => Icons::LIVEWIRE, 'text' => 'Livewire'],
            (object)['link' => Links::TAILWINDCSS ,'image' => Icons::TAILWINDCSS, 'text' => 'Tailwind CSS'],
        ]);
    }
};
?>

<section id="home" class="min-h-[calc(100vh-64px)] flex items-center justify-center bg-white">
    <div class="max-7-xl p-5 md:p-8 text-center">
        <p class="uppercase tracking-[0.3em] text-xs md:text-sm text-slate-800 mb-6">
            Web Developer • Software Engineer
        </p>
        
        <h1 class="text-5xl md:text-6xl font-black leading-tight mb-8">
            Leo Angelo Torres
        </h1>
        
        <p class="text-md md:text-lg text-slate-600 leading-relaxed max-w-2xl mb-8">
            Experienced web developer focused on creating
            responsive, scalable, and modern web applications
            with clean UI and efficient backend architecture.
        </p>
        
        <div class="flex justify-center gap-5 mb-10">
            @foreach ($icons as $icon)
            <a href="{{ $icon->link }}">
                <i title="{{ $icon->text }}" class="{{ $icon->image }} text-4xl md:text-5xl"></i>
            </a>
            @endforeach
        </div>

        <div class="flex justify-center gap-4">
            <a href="/docs/resume.pdf" download="Torres Leo Angelo.pdf"
                class="bg-slate-900 text-white text-sm md:text-base px-6 md:px-8 py-4 rounded-full font-medium hover:opacity-90 transition">
                Download CV
            </a>
            <button id="button-contact"
                class="border border-slate-300 text-sm md:text-base px-6 md:px-8 py-4 rounded-full font-medium hover:bg-[#f8fafc] transition">
                Contact Me
            </button>
        </div>
    </div>
</section>
