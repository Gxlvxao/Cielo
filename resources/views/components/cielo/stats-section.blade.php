<section class="bg-white pb-32 pt-10 px-6 relative z-10 border-b border-gray-100">
    <div class="max-w-[90rem] mx-auto">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 lg:gap-8 divide-y md:divide-y-0 md:divide-x divide-gray-100">
            
            <div class="pt-8 md:pt-0">
                <x-cielo.stat-counter 
                    label="{{ __('home.stats.years_label') }}" 
                    end="13" 
                    suffix="+" 
                    desc="{{ __('home.stats.years_desc') }}" 
                />
            </div>

            <div class="pt-8 md:pt-0">
                <x-cielo.stat-counter 
                    label="{{ __('home.stats.satisfaction_label') }}" 
                    end="98" 
                    suffix="%" 
                    desc="{{ __('home.stats.satisfaction_desc') }}" 
                />
            </div>

            <div class="pt-8 md:pt-0">
                <x-cielo.stat-counter 
                    label="{{ __('home.stats.sales_label') }}" 
                    end="120" 
                    suffix="+" 
                    desc="{{ __('home.stats.sales_desc') }}" 
                />
            </div>

            <div class="pt-8 md:pt-0">
                <x-cielo.stat-counter 
                    label="{{ __('home.stats.homeowners_label') }}" 
                    end="100" 
                    suffix="+" 
                    desc="{{ __('home.stats.homeowners_desc') }}" 
                />
            </div>

        </div>
    </div>
</section>