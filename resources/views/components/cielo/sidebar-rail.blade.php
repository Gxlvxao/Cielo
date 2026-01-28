<div class="hidden md:flex fixed left-0 top-0 h-screen w-20 z-50 flex-col items-center justify-between py-8 bg-cielo-dark/90 backdrop-blur-md border-r border-white/5 transition-all duration-300 hover:w-24 group">
    
    {{-- 1. Logo / Home Icon --}}
    <a href="{{ route('home') }}" class="p-3 text-white/80 hover:text-cielo-accent transition-colors duration-300 relative">
        <span class="sr-only">Home</span>
        {{-- Icone Simples de Casa ou Logo Reduzido --}}
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        
        {{-- Tooltip (Aparece no hover da sidebar) --}}
        <div class="absolute left-full top-1/2 -translate-y-1/2 ml-4 px-3 py-1 bg-white text-cielo-dark text-xs font-bold rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap">
            INÍCIO
        </div>
    </a>

    {{-- 2. Navigation Actions --}}
    <div class="flex flex-col gap-8 items-center">
        
        {{-- Search Trigger --}}
        <button @click="$dispatch('open-search')" class="p-3 text-white/60 hover:text-white transition-colors relative group/icon">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <div class="absolute left-full top-1/2 -translate-y-1/2 ml-4 px-3 py-1 bg-cielo-dark text-white border border-white/10 text-xs tracking-widest uppercase rounded opacity-0 group-hover/icon:opacity-100 transition-opacity pointer-events-none">
                Buscar
            </div>
        </button>

        {{-- Menu Hamburguer (O Principal) --}}
        <button @click="$dispatch('toggle-menu')" 
                class="p-3 text-white hover:text-cielo-accent transition-transform duration-300 hover:scale-110 relative group/icon">
            <div class="flex flex-col gap-1.5 items-end">
                <span class="block w-6 h-0.5 bg-current"></span>
                <span class="block w-4 h-0.5 bg-current group-hover/icon:w-6 transition-all duration-300"></span>
                <span class="block w-5 h-0.5 bg-current group-hover/icon:w-6 transition-all duration-300"></span>
            </div>
            <div class="absolute left-full top-1/2 -translate-y-1/2 ml-4 px-3 py-1 bg-cielo-dark text-white border border-white/10 text-xs tracking-widest uppercase rounded opacity-0 group-hover/icon:opacity-100 transition-opacity pointer-events-none">
                Menu
            </div>
        </button>
    </div>

    {{-- 3. Social / Contact --}}
    <div class="flex flex-col gap-6 items-center">
        <a href="#" class="text-white/40 hover:text-[#25D366] transition-colors" title="WhatsApp">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01C17.18 3.03 14.69 2 12.04 2zM12.05 20.21c-1.5 0-2.97-.39-4.26-1.15l-.3-.18-3.11.82.83-3.04-.2-.31c-.82-1.31-1.26-2.83-1.26-4.45 0-4.61 3.75-8.36 8.36-8.36 2.23 0 4.33.87 5.91 2.44 1.57 1.58 2.44 3.68 2.44 5.91 0 4.61-3.74 8.36-8.35 8.36z"/></svg>
        </a>
        <a href="#" class="text-white/40 hover:text-[#E1306C] transition-colors" title="Instagram">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01M7.8 21h8.4c1.9 0 3.1-1.1 3.1-3V6c0-1.9-1.2-3-3.1-3H7.8C5.9 3 4.7 4.1 4.7 6v12c0 1.9 1.2 3 3.1 3z"></path></svg>
        </a>
    </div>
</div>