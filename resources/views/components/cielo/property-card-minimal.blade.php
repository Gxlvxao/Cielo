@props(['property'])

<a href="{{ route('properties.show', $property) }}" class="group block cursor-pointer">
    <div class="relative overflow-hidden aspect-[4/5] bg-stone-200">
        <img src="{{ Storage::url($property->cover_image) }}" 
             alt="{{ $property->title }}" 
             class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
        
        @if($property->is_exclusive)
            <div class="absolute top-4 right-4 bg-stone-900 text-white text-[10px] uppercase tracking-widest px-3 py-1">
                Off-Market
            </div>
        @endif
    </div>

    <div class="mt-4 space-y-1">
        <h3 class="font-serif text-lg text-stone-800 italic group-hover:text-stone-600 transition-colors">
            {{ $property->title }}
        </h3>
        <p class="text-xs text-stone-500 uppercase tracking-widest">
            {{ $property->city }} @if($property->district) • {{ $property->district }} @endif
        </p>
        <p class="text-sm font-light text-stone-900 mt-2">
            {{ $property->formatted_price }}
        </p>
    </div>
</a>