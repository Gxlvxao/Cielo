<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="text-center mb-8">
            <h2 class="font-serif text-2xl text-cielo-dark">Welcome Back</h2>
            <p class="text-xs text-cielo-navy/60 uppercase tracking-widest mt-2">Client Access</p>
        </div>

        <div>
            <label for="email" class="block font-medium text-xs text-cielo-navy uppercase tracking-widest mb-2">
                {{ __('Email') }}
            </label>
            <input id="email" class="block w-full border-0 border-b border-gray-300 bg-transparent py-3 px-0 text-cielo-dark focus:border-cielo-terracotta focus:ring-0 transition-colors placeholder-gray-300" 
                   type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password" class="block font-medium text-xs text-cielo-navy uppercase tracking-widest mb-2">
                {{ __('Password') }}
            </label>
            <input id="password" class="block w-full border-0 border-b border-gray-300 bg-transparent py-3 px-0 text-cielo-dark focus:border-cielo-terracotta focus:ring-0 transition-colors placeholder-gray-300"
                   type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-cielo-dark shadow-sm focus:ring-cielo-dark/20 cursor-pointer" name="remember">
                <span class="ml-2 text-xs text-gray-500 group-hover:text-cielo-dark transition-colors">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs text-gray-400 hover:text-cielo-terracotta transition-colors underline decoration-transparent hover:decoration-cielo-terracotta underline-offset-4" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="mt-8">
            <button class="w-full bg-cielo-dark text-white uppercase tracking-[0.2em] text-xs font-bold py-4 hover:bg-cielo-terracotta transition-all duration-500">
                {{ __('Log in') }}
            </button>
        </div>
        
        <div class="text-center mt-6">
            <p class="text-xs text-gray-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-cielo-dark font-bold hover:text-cielo-terracotta transition-colors ml-1">
                    Sign up request
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>