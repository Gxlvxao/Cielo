<x-site-layout>
    
    {{-- Hero Fixo no Fundo --}}
    <x-cielo.hero-section />

    <div class="relative z-10 mt-[100vh] bg-white shadow-[0_-50px_100px_rgba(0,0,0,0.2)] rounded-t-[3rem] md:rounded-t-[5rem]">
        
        {{-- 1. About / Intro --}}
        <x-cielo.about-section />
        
        {{-- 2. Manifesto Deck (Vídeos) --}}
        <x-cielo.manifesto-deck />

        {{-- 3. Imóveis em Destaque --}}
        <x-cielo.featured-properties :properties="$properties" />
        
        {{-- 4. Nossas Competências --}}
        <x-cielo.expertises-section />

        {{-- 5. FAQ --}}
        <x-cielo.faq-section />

        {{-- 6. CLIENT STORIES (Depoimentos) --}}
        <x-cielo.clients-stories />

        {{-- 7. Parceiros --}}
        <x-cielo.partners-section />

        {{-- Footer --}}
        <x-cielo.footer-big />

    </div>

</x-site-layout>