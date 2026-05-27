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
</head>
<body class="bg-[#f8fafc] font-[#0f172a]">
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/80 backdrop-blur-xl">
        {{ $navbar }}
    </header>

    <main class="container mx-auto">
        {{ $content }} 
    </main>

    <footer class="border-t border-slate-200 py-6 bg-white/80 backdrop-blur-xl">
        <div class="mx-auto max-w-7xl px-6 text-center text-sm text-slate-500">
            &copy; {{ now()->year }} Portfolio by {{ config('app.owner') }}. All rights reserved.
        </div>
    </footer>

    {{ $others }}
</body>
</html>
