<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Cielo') }} - Client Area</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-cielo-dark selection:bg-cielo-terracotta selection:text-white">
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            
            <div class="mb-8">
                <a href="/" class="flex flex-col items-center group">
                    <h1 class="font-serif text-4xl text-white tracking-widest uppercase">Cielo</h1>
                    <span class="text-[10px] text-cielo-accent tracking-[0.4em] uppercase mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        Back to Home
                    </span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-[0_0_50px_rgba(0,0,0,0.5)] overflow-hidden sm:rounded-sm relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cielo-dark via-cielo-terracotta to-cielo-dark"></div>
                
                {{ $slot }}
            </div>

            <div class="mt-8 text-white/20 text-xs tracking-widest uppercase">
                © {{ date('Y') }} Cielo Real Estate
            </div>
        </div>
    </body>
</html>