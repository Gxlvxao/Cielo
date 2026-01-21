@props(['label', 'end', 'suffix' => '', 'desc'])

<div x-data="{ 
        current: 0, 
        end: {{ $end }}, 
        shown: false,
        init() {
            // Cria um observador nativo do navegador (Sem plugins)
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    this.shown = true;
                    this.animate();
                    observer.disconnect(); // Para de observar depois que ativou
                }
            }, { threshold: 0.2 }); // Ativa quando 20% do item estiver visível
            
            observer.observe(this.$el);
        },
        animate() {
            if (this.current === this.end) return;
            let start = 0;
            const duration = 2000;
            const step = timestamp => {
                if (!start) start = timestamp;
                const progress = Math.min((timestamp - start) / duration, 1);
                // Efeito easing (começa rápido, termina devagar)
                const easeOut = 1 - Math.pow(1 - progress, 3); 
                
                this.current = Math.floor(easeOut * (this.end - 0) + 0);
                
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    this.current = this.end; // Garante o número final exato
                }
            };
            window.requestAnimationFrame(step);
        }
     }"
     class="flex flex-col items-center text-center px-4 group">
    
    <span class="text-xs font-bold tracking-[0.2em] uppercase text-cielo-terracotta mb-4 h-6 block">
        {{ $label }}
    </span>

    <div class="font-serif text-6xl md:text-7xl lg:text-8xl text-cielo-dark leading-none mb-6 transition-all duration-700 transform"
         :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
        <span x-text="current">0</span><span class="text-4xl md:text-6xl text-cielo-accent ml-1 align-top">{{ $suffix }}</span>
    </div>

    <p class="text-sm text-cielo-navy/70 leading-relaxed max-w-xs mx-auto transition-opacity duration-1000 delay-500"
       :class="shown ? 'opacity-100' : 'opacity-0'">
        {{ $desc }}
    </p>
</div>