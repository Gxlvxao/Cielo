<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" 
            class="bg-stone-900 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:bg-stone-700 transition-all transform hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>

    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="absolute bottom-20 right-0 w-80 bg-white shadow-2xl rounded-lg overflow-hidden border border-stone-100">
         
         <div class="bg-stone-900 p-4">
             <p class="text-white font-serif italic text-sm">Concierge Cielo</p>
             <p class="text-stone-400 text-xs">Bot IA (Online)</p>
         </div>
         
         <div class="p-4 h-64 bg-stone-50 overflow-y-auto">
             <div class="bg-white p-3 rounded-br-xl rounded-tr-xl rounded-bl-xl shadow-sm max-w-[80%] text-sm text-stone-600">
                 Olá! Como posso ajudar a encontrar a energia perfeita para seu lar hoje?
             </div>
         </div>

         <div class="p-3 bg-white border-t border-stone-100">
             <input type="text" placeholder="Digite sua mensagem..." class="w-full text-sm border-none focus:ring-0 bg-transparent">
         </div>
    </div>
</div>