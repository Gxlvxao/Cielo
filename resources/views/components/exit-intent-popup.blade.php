<div x-data="{ 
        show: false,
        hasShown: false,
        init() {
            // Verifica se já mostrou na sessão
            if (sessionStorage.getItem('exit_intent_shown')) {
                this.hasShown = true;
                return;
            }

            // Detecta movimento do mouse para fora da tela (Desktop)
            document.addEventListener('mouseleave', (e) => {
                if (e.clientY <= 0 && !this.hasShown) {
                    this.open();
                }
            });

            // Timer simples para Mobile (após 30s)
            setTimeout(() => {
                if (!this.hasShown) this.open();
            }, 30000);
        },
        open() {
            this.show = true;
            this.hasShown = true;
            sessionStorage.setItem('exit_intent_shown', 'true');
        },
        close() {
            this.show = false;
        }
    }"
    x-show="show"
    x-transition.opacity
    style="display: none;"
    class="fixed inset-0 z-[100] flex items-center justify-center px-4">
    
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="close()"></div>

    {{-- Modal Content --}}
    <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden transform transition-all p-8 text-center border-t-4 border-cielo-terracotta">
        
        <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <span class="text-xs font-bold tracking-[0.2em] text-cielo-terracotta uppercase mb-4 block">Espere!</span>
        <h3 class="font-serif text-3xl text-cielo-dark mb-4">Ainda não encontrou a casa ideal?</h3>
        <p class="text-gray-600 mb-8 leading-relaxed">
            Muitas das nossas propriedades exclusivas são "Off-Market" e não estão listadas aqui. Junte-se ao nosso Private Circle.
        </p>

        <div class="flex gap-4 justify-center">
            <a href="{{ route('access-request.create') }}" class="px-6 py-3 bg-cielo-dark text-white text-sm font-bold uppercase tracking-widest rounded hover:bg-cielo-terracotta transition-colors">
                Solicitar Acesso
            </a>
            <button @click="close()" class="px-6 py-3 border border-gray-200 text-gray-500 text-sm font-bold uppercase tracking-widest rounded hover:border-gray-400 transition-colors">
                Agora Não
            </button>
        </div>
    </div>
</div>