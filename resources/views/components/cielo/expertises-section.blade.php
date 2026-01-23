<section class="bg-cielo-dark text-cielo-cream py-32 px-6 relative z-20">
    <div class="max-w-[90rem] mx-auto">
        
        <h2 class="font-serif text-5xl md:text-7xl mb-48 text-white">
            {{ __('home.expertise.main_title') }}
        </h2>

        <div class="space-y-0">
            @foreach(range(1, 5) as $i)
                <div x-data="{ 
                        shown: false,
                        init() {
                            const observer = new IntersectionObserver((entries) => {
                                if (entries[0].isIntersecting) {
                                    this.shown = true;
                                    observer.disconnect();
                                }
                            }, { threshold: 0.2 });
                            observer.observe(this.$el);
                        }
                     }"
                     class="group border-t border-white/10 py-16 transition-all duration-700 hover:bg-white/5"
                     :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                        
                        <div class="lg:col-span-4">
                            <span class="font-mono text-sm text-white mb-4 block opacity-60">
                                [0{{ $i }}]
                            </span>
                            <h3 class="font-serif text-3xl md:text-4xl text-white italic group-hover:translate-x-2 transition-transform duration-500">
                                {{ __("home.expertise.$i.title") }}
                            </h3>
                        </div>

                        <div class="lg:col-span-5">
                            <p class="font-sans font-light text-white/70 leading-relaxed text-lg max-w-xl group-hover:text-white/90 transition-colors duration-500">
                                {{ __("home.expertise.$i.desc") }}
                            </p>
                        </div>

                        <div class="lg:col-span-3 pt-4 lg:pt-0">
                            {{-- AQUI É ONDE DAVA O ERRO: Agora o PHP espera que 'tags' seja um array --}}
                            <ul class="space-y-3 border-l border-white/10 pl-6 lg:pl-8">
                                @foreach(__("home.expertise.$i.tags") as $tag)
                                    <li class="text-xs uppercase tracking-widest text-white/60 block transform transition-all duration-300 group-hover:translate-x-1 group-hover:text-white">
                                        {{ $tag }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="border-t border-white/10"></div>

    </div>
</section>