<x-site-layout>
    <x-slot name="title">{{ __('fengshui.title') }}</x-slot>

    {{-- Hero Section Minimalista --}}
    <section class="relative pt-32 pb-20 px-6 bg-cielo-cream overflow-hidden">
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <span class="inline-block py-1 px-3 border border-cielo-terracotta/30 rounded-full text-cielo-terracotta text-xs tracking-[0.2em] uppercase mb-6">
                Energy & Balance
            </span>
            <h1 class="font-serif text-5xl md:text-7xl text-cielo-dark mb-6">
                {{ __('fengshui.title') }}
            </h1>
            <p class="font-light text-lg md:text-xl text-cielo-navy/60 max-w-2xl mx-auto">
                {{ __('fengshui.intro_text') }}
            </p>
        </div>

        {{-- Círculo Decorativo --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-cielo-terracotta/10 rounded-full pointer-events-none animate-[spin_60s_linear_infinite]"></div>
    </section>

    {{-- Seção do Formulário / Resultado --}}
    <section class="py-20 px-6 bg-white relative">
        <div class="max-w-3xl mx-auto">
            
            {{-- Se houver resultado, mostra o Card de Perfil --}}
            @if(isset($result))
                <div class="bg-cielo-cream p-12 rounded-3xl shadow-xl text-center border border-cielo-terracotta/10" x-data x-init="$el.scrollIntoView({behavior: 'smooth', block: 'center'})">
                    
                    <div class="w-24 h-24 mx-auto bg-cielo-dark rounded-full flex items-center justify-center text-cielo-cream font-serif text-4xl mb-8 shadow-lg">
                        {{ $result['kua_number'] }}
                    </div>

                    <h2 class="font-serif text-3xl text-cielo-dark mb-2">{{ $result['vibe_tag'] }}</h2>
                    <p class="text-cielo-terracotta uppercase tracking-widest text-sm mb-8 font-bold">{{ $result['element'] }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left max-w-xl mx-auto">
                        <div class="bg-white p-6 rounded-xl border border-gray-100">
                            <h3 class="text-xs uppercase tracking-widest text-gray-400 mb-3">{{ __('fengshui.results.favorable_directions') }}</h3>
                            <ul class="space-y-2">
                                @foreach($result['favorable_directions'] as $dir)
                                    <li class="flex items-center gap-2 text-cielo-dark font-medium">
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        {{ $dir }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        {{-- CTA para consultoria --}}
                        <div class="flex flex-col justify-center items-center text-center space-y-4">
                            <p class="text-sm text-gray-500 italic">
                                "{{ __('fengshui.results.cta_text') }}"
                            </p>
                            <a href="{{ route('pages.contact') }}" class="px-6 py-3 bg-cielo-dark text-white text-xs uppercase tracking-widest rounded hover:bg-cielo-terracotta transition-colors w-full">
                                {{ __('fengshui.results.cta_btn') }}
                            </a>
                        </div>
                    </div>

                    <div class="mt-12 pt-8 border-t border-cielo-dark/5">
                        <a href="{{ route('tools.feng-shui') }}" class="text-xs text-gray-400 hover:text-cielo-dark underline transition-colors">
                            Recalcular
                        </a>
                    </div>
                </div>

            @else
                {{-- Formulário de Entrada --}}
                <form action="{{ route('tools.feng-shui') }}" method="POST" class="bg-gray-50 p-10 md:p-14 rounded-3xl shadow-sm border border-gray-100">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        {{-- Data de Nascimento --}}
                        <div class="space-y-2">
                            <label for="birth_date" class="block text-xs uppercase tracking-widest text-gray-500 font-bold ml-1">
                                {{ __('fengshui.form.birth_date') }}
                            </label>
                            <input type="date" name="birth_date" id="birth_date" required
                                   class="w-full bg-white border-gray-200 rounded-xl px-4 py-3 text-cielo-dark focus:border-cielo-terracotta focus:ring-cielo-terracotta transition-all shadow-sm">
                        </div>

                        {{-- Género --}}
                        <div class="space-y-2">
                            <label for="gender" class="block text-xs uppercase tracking-widest text-gray-500 font-bold ml-1">
                                {{ __('fengshui.form.gender') }}
                            </label>
                            <select name="gender" id="gender" required
                                    class="w-full bg-white border-gray-200 rounded-xl px-4 py-3 text-cielo-dark focus:border-cielo-terracotta focus:ring-cielo-terracotta transition-all shadow-sm cursor-pointer">
                                <option value="" disabled selected>Selecionar...</option>
                                <option value="female">{{ __('fengshui.form.female') }}</option>
                                <option value="male">{{ __('fengshui.form.male') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="group relative inline-flex items-center justify-center px-8 py-4 bg-cielo-dark text-white overflow-hidden rounded-full transition-all hover:bg-cielo-terracotta shadow-lg hover:shadow-xl hover:-translate-y-1">
                            <span class="absolute w-0 h-0 transition-all duration-500 ease-out bg-white rounded-full group-hover:w-56 group-hover:h-56 opacity-10"></span>
                            <span class="relative text-sm font-bold tracking-[0.2em] uppercase">
                                {{ __('fengshui.form.calculate_btn') }}
                            </span>
                        </button>
                    </div>
                </form>
            @endif

        </div>
    </section>
</x-site-layout>