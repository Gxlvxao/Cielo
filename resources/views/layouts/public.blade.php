<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Crow Global') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|playfair-display:400,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        /* Scrollbar fina e moderna */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c9a35e; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #b08d4b; }
    </style>
</head>
<body class="font-sans antialiased text-graphite bg-gray-50 selection:bg-[#c9a35e] selection:text-white">
    <div class="min-h-screen flex flex-col">
        {{ $slot ?? '' }}
        @yield('content')
    </div>

    {{-- Componente de Banner de Cookies --}}
    <x-cookie-banner />

    {{-- Floating Action Buttons --}}
    <div class="fixed bottom-6 right-6 flex flex-col gap-4 z-50" x-data="{ showTop: false }" @scroll.window="showTop = (window.pageYOffset > 300)">
        
        {{-- Back Button --}}
        <button onclick="window.history.back()" 
                class="w-12 h-12 bg-white text-gray-800 rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50 hover:scale-110 transition-all duration-300 border border-gray-200"
                title="{{ __('Go Back') }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </button>

        {{-- WhatsApp Button --}}
        <a href="https://wa.me/351918765491" target="_blank" 
           class="w-12 h-12 bg-[#25D366] text-white rounded-full shadow-lg flex items-center justify-center hover:bg-[#20bd5a] hover:scale-110 transition-all duration-300"
           title="WhatsApp">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-8.68-2.031-9.67-.272-.161-.47-.149-.734-.15-1.29 0-2.135.25-3.235.619-3.243 2.65 3.465 5.06 6.139 5.792.835 1.127 1.34 3.09 1.63 3.662.3.57.546.619.895.669.347.05 1.05.744 1.218.868.167.124.275.248.125.496-.149.248-.87 1.29-.982 1.488-.112.198-.415.223-.694.099-.272-.124-1.397-.619-2.327-1.439-1.258-1.114-2.108-2.478-2.355-2.923-.05-.248.026-.446.336-.757l.556-.706c.075-.124.037-.248-.025-.372-.062-.124-.62-1.242-1.02-1.615-.402-.375-.623-.332-.821-.332-.198 0-.463.028-.705.028-.248 0-.645.099-.97.471-.325.372-1.264 1.254-1.264 3.064 0 1.81 1.313 3.56 1.488 3.808.174.248 2.508 3.045 6.077 4.545 2.193.921 3.148.98 4.316.719 1.278-.285 2.45-1.503 2.548-2.208.099-.705.472-1.575.124-2.208z"/>
            </svg>
        </a>

        {{-- Scroll to Top Button --}}
        <button x-show="showTop" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-4"
                @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                class="w-12 h-12 bg-[#CD7F32] text-white rounded-full shadow-lg flex items-center justify-center hover:bg-[#b06d2b] hover:scale-110 transition-all duration-300"
                title="{{ __('Back to Top') }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>
    </div>
</body>
</html>