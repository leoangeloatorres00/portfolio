<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="description" content="Portfolio of Leo Angelo Torres, a full-stack web developer with 10 years of experience creating modern web applications, scalable solutions, and responsive user experiences using Laravel, PHP, JavaScript, and Tailwind CSS."> 

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="/images/logo.png">
    
    <title>{{ $title ?? 'Portfolio' }}</title>

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    
    <style>
        html {
            scroll-behavior: smooth;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            ;
        }

        header {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
        }

        section {
            scroll-margin-top: 64px;
            padding: 20px;
        }

        .fade-item {
            animation-duration: 700ms;
            animation-fill-mode: forwards;
            animation-timing-function: ease-in;
            opacity: 0;
        }

        .fade-delay {
            animation-delay: 0.25s;
        }

        .fade-delay-staggared {
            animation-duration: calc(var(--i) * 0.5s);
        }

        /* Fade In Up */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation-name: fadeInUp;
        }

        /* Fade In Left (moves from left to center) */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .fade-left {
            animation-name: fadeInLeft;
        }

        /* Fade In Right (moves from right to center) */
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .fade-right {
            animation-name: fadeInRight;
        }
    </style>
</head> 

<body class="bg-[#f8fafc] text-slate-800">
    <header class="w-full mx-auto z-50 border-b border-slate-200 shadow-sm bg-white backdrop-blur">
        {{ $navbar }}
    </header>

    <main class="container w-full mx-auto">
        {{ $content }} 
    </main>

    <footer class="border-t border-slate-200 py-6 bg-white/80 backdrop-blur-xl">
        <div class="mx-auto max-w-7xl px-6 text-center text-sm text-slate-500">
            &copy; {{ now()->year }} Portfolio by {{ config('app.owner') }}. All rights reserved.
            <span id="isMobileInDesktopMode"></span>
        </div>
    </footer>

    {{ $others }}
    <script>
        const height = window.outerHeight + 'px';

        const section = document.querySelectorAll('section');

        const isMobileInDesktopMode = () => {
            const ua = navigator.userAgent;
            
            const isIOSDesktopMode = 
                ua.includes("Macintosh") && 
                (navigator.maxTouchPoints > 1);

            const isAndroidDesktopMode = 
                ua.includes("Linux x86_64") && 
                (navigator.maxTouchPoints > 1);

            return isIOSDesktopMode || isAndroidDesktopMode;
        }

        function handleBackdrop(element) {
            element.classList.toggle('hidden');

            const isOpen = element.classList.contains('hidden');
            document.body.style.overflow = isOpen ? 'auto' : 'hidden';
        }

        function detectZoom() {
            const zoom = window.devicePixelRatio;

            section.forEach(element => {
                if(isMobileInDesktopMode()) {
                    document.getElementById('isMobileInDesktopMode').innerHTML = `mobile desktop mode ${window.outerHeight/2}px`
                    element.classList.remove('min-h-[calc(100vh-64px)]');
                    
                    element.style.height = `${window.outerHeight/2}px`;
                } else {
                    document.getElementById('isMobileInDesktopMode').innerHTML = "no mobile desktop mode"

                    element.classList.toggle('min-h-[calc(100vh-64px)]', zoom >= 1);

                    if(zoom < 1) {
                        element.style.height = height;
                    } else {
                        element.style.removeProperty('height');
                    }
                }
            });
        }

        window.addEventListener('resize', detectZoom);

        detectZoom();
    </script>
</body>
</html>
