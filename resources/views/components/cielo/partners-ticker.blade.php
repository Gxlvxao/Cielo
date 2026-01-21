<div class="relative overflow-hidden w-full h-16 bg-white flex items-center">
    <div class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-white to-transparent z-10"></div>
    <div class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-white to-transparent z-10"></div>

    <div class="flex animate-marquee whitespace-nowrap items-center">
        @for ($i = 0; $i < 2; $i++)
            <div class="flex space-x-16 mx-8 items-center opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                <img src="/images/maxsell.png" class="h-8 w-auto object-contain" alt="Maxsell">
                
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/1200px-Google_2015_logo.svg.png" class="h-6 w-auto" alt="Partner">
                <span class="text-xl font-serif text-stone-400">Sotheby's</span>
                <span class="text-xl font-serif text-stone-400">Christie's</span>
                <span class="text-xl font-serif text-stone-400">Berkshire Hathaway</span>
                <span class="text-xl font-serif text-stone-400">Savills</span>
            </div>
        @endfor
    </div>
</div>

<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 20s linear infinite;
    }
    .animate-marquee:hover {
        animation-play-state: paused;
    }
</style>