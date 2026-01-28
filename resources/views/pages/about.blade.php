<x-site-layout>
    
    {{-- 1. INTRODUÇÃO (Texto Duplo) --}}
    <section class="bg-white pt-48 pb-24 px-6 relative z-10">
        <div class="max-w-5xl mx-auto">
            
            {{-- BLOCO 1: PROPOSTA DE VALOR --}}
            <div class="mb-20 md:w-3/4">
                <span class="font-sans text-xs font-bold tracking-[0.3em] uppercase text-cielo-terracotta mb-8 block">
                    {{ __('about.value.label') }}
                </span>

                <h1 class="font-display text-4xl md:text-5xl lg:text-6xl leading-tight text-cielo-dark mb-8">
                    {!! __('about.value.title') !!}
                </h1>

                <div class="font-sans text-lg md:text-xl text-cielo-navy/80 leading-relaxed font-light text-justify">
                    <p class="mb-6">{{ __('about.value.text_1') }}</p>
                    <p>{{ __('about.value.text_2') }}</p>
                </div>
            </div>

            {{-- BLOCO 2: PERSONALIDADE DA MARCA --}}
            {{-- Layout deslocado para a direita com borda lateral para criar hierarquia --}}
            <div class="flex justify-end">
                <div class="md:w-2/3 pl-6 md:pl-12 border-l-2 border-cielo-terracotta/20">
                    <span class="font-sans text-xs font-bold tracking-[0.3em] uppercase text-gray-400 mb-6 block">
                        {{ __('about.personality.label') }}
                    </span>
                    
                    <p class="font-sans text-base md:text-lg text-gray-500 leading-relaxed text-justify">
                        {{ __('about.personality.text') }}
                    </p>
                </div>
            </div>

        </div>
    </section>

    {{-- 2. STATS --}}
    <x-cielo.stats-section />

    {{-- 3. PROCESSO (Ícones Mantidos) --}}
    <section class="bg-gray-50 py-32 px-6">
        <div class="max-w-[90rem] mx-auto">
            
            <div class="mb-20 max-w-3xl">
                <h2 class="font-display text-4xl md:text-5xl text-cielo-dark mb-6">
                    {{ __('about.process.title') }}
                </h2>
                <div class="h-1 w-20 bg-cielo-terracotta"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-16">
                @foreach(__('about.process.items') as $item)
                    <div class="group">
                        {{-- Ícones SVG Originais --}}
                        <div class="w-12 h-12 mb-6 text-cielo-dark group-hover:text-cielo-terracotta transition-colors duration-300">
                            @if($loop->index == 0) {{-- Expert Guidance --}}
                                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                            @elseif($loop->index == 1) {{-- Transparent Costs --}}
                                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            @elseif($loop->index == 2) {{-- Step-by-Step --}}
                                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            @elseif($loop->index == 3) {{-- Local Climate --}}
                                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @elseif($loop->index == 4) {{-- Local Team --}}
                                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            @else {{-- Move In Ready --}}
                                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                            @endif
                        </div>

                        <h3 class="font-display text-2xl text-cielo-dark mb-4">
                            {{ $item['title'] }}
                        </h3>

                        <p class="font-sans font-light text-cielo-navy/70 leading-relaxed">
                            {{ $item['desc'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 4. FOOTER BIG --}}
    <x-cielo.footer-big />

</x-site-layout>