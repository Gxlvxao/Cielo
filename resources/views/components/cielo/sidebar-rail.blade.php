<div class="hidden md:flex fixed left-0 top-0 h-screen w-20 z-50 flex-col items-center justify-between py-8 bg-cielo-dark/95 backdrop-blur-md border-r border-white/5 transition-all duration-300 hover:w-24 group">
    
    {{-- 1. Logo / Home Icon --}}
    <a href="{{ route('home') }}" class="p-3 text-white/80 hover:text-cielo-accent transition-colors duration-300 relative group/tooltip">
        <span class="sr-only">Home</span>
        
        {{-- LOGO CLEAN (Substituindo o ícone SVG) --}}
        <img src="{{ asset('images/clean.png') }}" 
             alt="Cielo Home" 
             class="w-6 h-6 object-contain brightness-0 invert"> 
        
        {{-- Tooltip --}}
        <div class="absolute left-full top-1/2 -translate-y-1/2 ml-4 px-3 py-1 bg-white text-cielo-dark text-[10px] font-bold tracking-widest uppercase rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap shadow-lg">
            {{ __('nav.tooltip_home') }}
        </div>
    </a>

    {{-- 2. Navegação Rápida (Links Diretos) --}}
    <div class="flex flex-col gap-6 items-center">
        
        {{-- Conceito --}}
        <a href="{{ route('pages.about') }}" class="p-2 text-white/50 hover:text-white transition-colors relative group/tooltip">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
            </svg>
            <div class="absolute left-full top-1/2 -translate-y-1/2 ml-4 px-3 py-1 bg-white text-cielo-dark text-[10px] font-bold tracking-widest uppercase rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap shadow-lg">
                {{ __('nav.tooltip_concept') }}
            </div>
        </a>

        {{-- Curadoria (Grid) --}}
        <a href="{{ route('properties.index') }}" class="p-2 text-white/50 hover:text-white transition-colors relative group/tooltip">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            <div class="absolute left-full top-1/2 -translate-y-1/2 ml-4 px-3 py-1 bg-white text-cielo-dark text-[10px] font-bold tracking-widest uppercase rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap shadow-lg">
                {{ __('nav.tooltip_curation') }}
            </div>
        </a>

        {{-- Journal (Book) --}}
        <a href="{{ route('blog.index') }}" class="p-2 text-white/50 hover:text-white transition-colors relative group/tooltip">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <div class="absolute left-full top-1/2 -translate-y-1/2 ml-4 px-3 py-1 bg-white text-cielo-dark text-[10px] font-bold tracking-widest uppercase rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap shadow-lg">
                {{ __('nav.tooltip_journal') }}
            </div>
        </a>

        {{-- Off-Market (Lock) --}}
        <a href="{{ route('access-request.create') }}" class="p-2 text-white/50 hover:text-cielo-terracotta transition-colors relative group/tooltip">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <div class="absolute left-full top-1/2 -translate-y-1/2 ml-4 px-3 py-1 bg-white text-cielo-dark text-[10px] font-bold tracking-widest uppercase rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap shadow-lg">
                {{ __('nav.tooltip_private') }}
            </div>
        </a>

        {{-- Contacto (Chat) --}}
        <a href="{{ route('pages.contact') }}" class="p-2 text-white/50 hover:text-white transition-colors relative group/tooltip">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <div class="absolute left-full top-1/2 -translate-y-1/2 ml-4 px-3 py-1 bg-white text-cielo-dark text-[10px] font-bold tracking-widest uppercase rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap shadow-lg">
                {{ __('nav.tooltip_contact') }}
            </div>
        </a>

    </div>

    {{-- 3. Actions (Search & Menu) --}}
    <div class="flex flex-col gap-6 items-center">
        
        {{-- Search Trigger --}}
        <button @click="$dispatch('open-search')" class="p-2 text-white/60 hover:text-white transition-colors relative group/tooltip">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <div class="absolute left-full top-1/2 -translate-y-1/2 ml-4 px-3 py-1 bg-white text-cielo-dark text-[10px] font-bold tracking-widest uppercase rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap shadow-lg">
                {{ __('nav.tooltip_search') }}
            </div>
        </button>

        {{-- Menu Hamburguer --}}
        <button @click="$dispatch('toggle-menu')" 
                class="p-2 text-white hover:text-cielo-accent transition-transform duration-300 hover:scale-110 relative group/tooltip">
            <div class="flex flex-col gap-1.5 items-end">
                <span class="block w-6 h-0.5 bg-current"></span>
                <span class="block w-4 h-0.5 bg-current group-hover/tooltip:w-6 transition-all duration-300"></span>
                <span class="block w-5 h-0.5 bg-current group-hover/tooltip:w-6 transition-all duration-300"></span>
            </div>
            <div class="absolute left-full top-1/2 -translate-y-1/2 ml-4 px-3 py-1 bg-white text-cielo-dark text-[10px] font-bold tracking-widest uppercase rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap shadow-lg">
                {{ __('nav.tooltip_menu') }}
            </div>
        </button>
    </div>

    {{-- 4. Social Media (Stack Atualizado) --}}
    <div class="flex flex-col gap-4 items-center mb-4">
        
        {{-- Instagram --}}
        <a href="https://www.instagram.com/casablanca.pt/" target="_blank" class="text-white/30 hover:text-[#E1306C] transition-colors relative group/tooltip" title="Instagram">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01M7.8 21h8.4c1.9 0 3.1-1.1 3.1-3V6c0-1.9-1.2-3-3.1-3H7.8C5.9 3 4.7 4.1 4.7 6v12c0 1.9 1.2 3 3.1 3z"></path></svg>
        </a>

        {{-- Facebook --}}
        <a href="https://www.facebook.com/casablancaproperty" target="_blank" class="text-white/30 hover:text-[#1877F2] transition-colors relative group/tooltip" title="Facebook">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
        </a>

        {{-- LinkedIn --}}
        <a href="#" target="_blank" class="text-white/30 hover:text-[#0A66C2] transition-colors relative group/tooltip" title="LinkedIn">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
        </a>

        {{-- YouTube --}}
        <a href="#" target="_blank" class="text-white/30 hover:text-[#FF0000] transition-colors relative group/tooltip" title="YouTube">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
        </a>

    </div>

</div>