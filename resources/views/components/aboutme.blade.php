<?php

use Livewire\Component;

new class extends Component
{
    public $skills;

    public function mount()
    {
        $this->skills = collect([
            (object)['title' => ' 9+ Years Experience', 'description' => 'Experienced in building scalable web applications, business systems, and responsive digital products.'],
            (object)['title' => 'Frontend Development', 'description' => 'Creating modern interfaces using HTML, CSS, JavaScript, TailwindCSS, Vue.js, and React.'],
            (object)['title' => 'Backend Development', 'description' => 'Building secure backend architecture with Laravel, PHP, APIs, authentication, and databases.'],
            (object)['title' => ' UI / UX & Performance', 'description' => 'Focused on responsive layouts, clean design systems, accessibility, and optimized user experience.'],
        ]);
    }
}
?>

 <section id="about" class="min-h-[calc(100vh-64px)] flex items-center justify-center">
    <div class="max-7-xl p-5">
        <div class="grid lg:grid-cols-2 gap-10">
            <div id="profile"
                class="relative hidden lg:block text-center mx-auto fade-item fade-delay fade-left">
                <div class=" absolute inset-0 rounded-[40px] p-2 bg-slate-200 rotate-6">
                    <div class="rounded-[30px] min-w-[387px] w-full h-[580px]"></div>
                </div>
                <div class="relative rounded-[40px] p-6">
                    <img src="{{ asset('images/profile.jpg') }}" loading="lazy" alt="Profile"
                        class="rounded-[30px] min-w-[387px] w-full h-[580px] object-cover" />
                </div>
            </div>

            <div id="description" class="flex items-start md:items-center fade-item fade-right">
                <div>
                    <p class=" uppercase tracking-[0.3em] text-xs md:text-sm text-slate-800 mb-3">
                        About Me
                    </p>

                    <h2 class="text-3xl md:text-4xl font-black leading-tight mb-4">
                        Creating Modern
                        <span class="text-slate-400">Digital Experiences</span>
                    </h2>

                    <p class="text-sm md:text-base text-slate-600 leading-relaxed mb-4">
                        My workflow combines clean development practices,
                        modern technologies, and user-focused design to
                        create high-quality digital experiences.
                    </p>

                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach ($skills as $skill)
                            <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-6">
                                <div class="relative z-10">
                                    <h3 class="text-md md:text-lg font-black leading-tight mb-2">
                                       {{ $skill->title }}
                                    </h3>
                                    <p class="text-slate-600 text-[10px] leading-relaxed mb-0">
                                        {{ $skill->description }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @script
    <script>
        const about = document.getElementById('about');
        const profile = document.getElementById('profile');
        const description = document.getElementById('description');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                profile.classList.toggle('fade-left', entry.isIntersecting);
                description.classList.toggle('fade-right', entry.isIntersecting);
            });
        }, {
            threshold: 0.3
        });

        observer.observe(about);
    </script>
    @endscript
</section>