<?php

use Livewire\Component;

new class extends Component
{
    public $data;

    public function mount()
    {
        $this->data = collect([
            (object)['title' => ' 9+ Years Experience', 'description' => 'Experienced in building scalable web applications, business systems, and responsive digital products.'],
            (object)['title' => 'Frontend Development', 'description' => 'Creating modern interfaces using HTML, CSS, JavaScript, TailwindCSS, Vue.js, and React.'],
            (object)['title' => 'Backend Development', 'description' => 'Building secure backend architecture with Laravel, PHP, APIs, authentication, and databases.'],
            (object)['title' => ' UI / UX & Performance', 'description' => 'Focused on responsive layouts, clean design systems, accessibility, and optimized user experience.'],
        ]);
    }
}
?>

<section id="about" class="py-28">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-24 items-center">
        <div class="photo relative hidden lg:block opacity-0 -translate-x-16 transition-all duration-1000">
            <div class="absolute inset-0 bg-slate-200 rounded-[40px] rotate-6"></div>
            
            <div class="relative glass rounded-[40px] p-6">
                <img src="{{ asset('images/profile.jpg') }}" alt="Profile"
                class="rounded-[30px] w-full h-[580px] object-cover" />
            </div>
        </div>

        <div class="description opacity-0 translate-x-16 transition-all duration-1000">
            <p class="uppercase tracking-[0.3em] text-sm text-slate-400 mb-5">
                About Me
            </p>

            <h2 class="text-5xl font-black leading-tight mb-8">
                Creating Modern
                <span class="text-slate-400">Digital Experiences</span>
            </h2>

            <p class="text-slate-600 leading-relaxed mb-8">
                My workflow combines clean development practices,
                modern technologies, and user-focused design to
                create high-quality digital experiences.
            </p>

            <div class="grid md:grid-cols-2 gap-4">
                @foreach ($data as $item)
                    <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative z-10">
                            <h3 class="text-lg font-black leading-tight mb-2">
                                {{ $item->title }}
                            </h3>

                            <p class="text-slate-600 text-xs leading-relaxed">
                               {{ $item->description }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @script
    <script>
        const section = document.querySelector("#about");
        const photo = document.querySelectorAll(".photo");
        const description = document.querySelectorAll(".description");

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                photo.forEach(element => {
                    element.classList.toggle('opacity-0', !entry.isIntersecting);
                    element.classList.toggle('-translate-x-16', !entry.isIntersecting);
                    element.classList.toggle('opacity-100', entry.isIntersecting);
                    element.classList.toggle('translate-x-0', entry.isIntersecting);
                });

                description.forEach(element => {
                    element.classList.toggle('opacity-0', !entry.isIntersecting);
                    element.classList.toggle('translate-x-16', !entry.isIntersecting);
                    element.classList.toggle('opacity-100', entry.isIntersecting);
                    element.classList.toggle('translate-x-0', entry.isIntersecting);
                });
            });
        }, {
            threshold: 0.3
        });

        observer.observe(section);
    </script>
    @endscript
</section>
