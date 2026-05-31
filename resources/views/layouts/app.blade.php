<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="/images/logo.png">
    
    <title>{{ $title ?? 'Portfolio' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <style>
        html {
            scroll-behavior: smooth;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            ;
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
    <header class="sticky top-0 z-50 border-b border-slate-200 shadow-sm">
        {{ $navbar }}
    </header>

    <main class="container w-full mx-auto ">
        {{ $content }} 
    </main>

    <footer class="border-t border-slate-200 py-6 bg-white/80 backdrop-blur-xl">
        <div class="mx-auto max-w-7xl px-6 text-center text-sm text-slate-500">
            &copy; {{ now()->year }} Portfolio by {{ config('app.owner') }}. All rights reserved.
        </div>
    </footer>

    {{ $others }}
    <script>
        const height = window.outerHeight + 'px';

        const section = document.querySelectorAll('section');

         function handleBackdrop(element) {
            element.classList.toggle('hidden');

            const isOpen = element.classList.contains('hidden');
            document.body.style.overflow = isOpen ? 'auto' : 'hidden';
        }

        function detectZoom() {
            const zoom = window.devicePixelRatio;

            section.forEach(element => {
                element.classList.toggle(`min-h-[${height}]`, zoom < 1)
                element.classList.toggle('min-h-[calc(100vh-64px)]', zoom >= 1)
            });
        }

        window.addEventListener('resize', detectZoom);

        detectZoom();
    </script>
</body>
</html>
