<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Cielo') }}</title>

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-cielo-dark antialiased bg-cielo-cream">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            {{-- Logo --}}
            <div class="mb-6">
                <a href="/" class="flex flex-col items-center group">
                    <div class="w-16 h-16 bg-cielo-terracotta rounded-full flex items-center justify-center text-white font-serif font-bold text-3xl shadow-lg group-hover:scale-110 transition-transform duration-500">
                        C
                    </div>
                    <span class="mt-4 font-serif text-2xl tracking-widest text-cielo-dark uppercase">Cielo</span>
                </a>
            </div>

            {{-- Card de Login --}}
            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border border-cielo-dark/5">
                {{ $slot }}
            </div>
            
            {{-- Footer Simples --}}
            <div class="mt-8 text-center text-xs text-cielo-navy/40 uppercase tracking-widest">
                &copy; {{ date('Y') }} Cielo Real Estate
            </div>
        </div>
    </body>
</html>