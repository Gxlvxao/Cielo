<x-site-layout>
    
    {{-- Hero Fixo no Fundo --}}
    <x-cielo.hero-section />

    {{-- 
        CONTEÚDO QUE SOBE SOBRE O HERO
        1. mt-[100vh]: Garante que começa abaixo do hero.
        2. Removi 'mx-...' para ocupar a largura total (Full Width).
        3. Removi 'overflow-hidden': ISSO É CRUCIAL PARA O STICKY SCROLL FUNCIONAR!
    --}}
    <div class="relative z-10 mt-[100vh] bg-white shadow-[0_-50px_100px_rgba(0,0,0,0.2)] rounded-t-[3rem] md:rounded-t-[5rem]">
        
        {{-- 1. About --}}
        <x-cielo.about-section />
        
        {{-- 2. Imóveis (Teste do Sticky) --}}
        {{-- Certifique-se que $properties está sendo passado pelo Controller --}}
        <x-cielo.properties-section :properties="$properties" />
        
        {{-- 3. Nossas Competências --}}
        <x-cielo.expertises-section />

        {{-- 4. FAQ --}}
        <x-cielo.faq-section />

        {{-- 5. Parceiros (Por último) --}}
        <x-cielo.partners-section />

        {{-- Footer --}}
        <x-cielo.footer-big />

    </div>

</x-site-layout>