<x-cielo-layout>
    
    <x-cielo.hero-section />

    <div class="relative z-10 mt-[100vh] bg-white shadow-[0_-50px_100px_rgba(0,0,0,0.2)] rounded-t-[3rem] overflow-hidden">
        
        <x-cielo.about-section />
        
        <x-cielo.stats-section />
        
        <x-cielo.properties-section :properties="$energyProperties" />
        
        <x-cielo.expertises-section />

        <x-cielo.partners-section />

        <x-cielo.testimonials-section />

        <x-cielo.blog-section :posts="$posts ?? collect([])" />

        <x-cielo.faq-section />

        <x-cielo.footer-big />

    </div>

</x-cielo-layout>