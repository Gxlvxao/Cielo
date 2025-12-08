<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-graphite leading-tight font-heading">
            {{ __('messages.edit') }}: {{ $property->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('properties.update', $property) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-graphite mb-4 border-b pb-2">{{ __('messages.main_info') }}</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.title_label') }}</label>
                                    <input type="text" name="title" value="{{ old('title', $property->title) }}" required class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.description_label') }}</label>
                                    <textarea name="description" rows="5" required class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent">{{ old('description', $property->description) }}</textarea>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.status_label') }}</label>
                                        <select name="status" class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent font-bold text-graphite">
                                            <option value="draft" {{ $property->status == 'draft' ? 'selected' : '' }}>{{ __('messages.draft') }}</option>
                                            <option value="active" {{ $property->status == 'active' ? 'selected' : '' }}>{{ __('messages.active') }}</option>
                                            <option value="negotiating" {{ $property->status == 'negotiating' ? 'selected' : '' }}>⚠ {{ __('messages.negotiating') }}</option>
                                        </select>
                                        <p class="text-xs text-gray-500 mt-1">{{ __('messages.negotiating_text') }}</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.price_label') }}</label>
                                        <input type="number" name="price" value="{{ old('price', $property->price) }}" required class="w-full rounded-lg border-gray-300 focus:border-accent focus:ring-accent font-bold">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.type_label') }}</label>
                                        <select name="type" class="w-full rounded-lg border-gray-300">
                                            @foreach(['apartment','house','villa','land','commercial','office'] as $t)
                                                <option value="{{ $t }}" {{ $property->type == $t ? 'selected' : '' }}>{{ __('messages.'.$t) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.transaction_label') }}</label>
                                        <select name="transaction_type" class="w-full rounded-lg border-gray-300">
                                            <option value="sale" {{ $property->transaction_type == 'sale' ? 'selected' : '' }}>{{ __('messages.sale') }}</option>
                                            <option value="rent" {{ $property->transaction_type == 'rent' ? 'selected' : '' }}>{{ __('messages.rent') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-graphite mb-4 border-b pb-2">{{ __('messages.details_areas') }}</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                <div><label class="text-xs font-bold">{{ __('messages.bedrooms') }}</label><input type="number" name="bedrooms" value="{{ $property->bedrooms }}" class="w-full rounded-lg border-gray-300"></div>
                                <div><label class="text-xs font-bold">{{ __('messages.bathrooms') }}</label><input type="number" name="bathrooms" value="{{ $property->bathrooms }}" class="w-full rounded-lg border-gray-300"></div>
                                <div><label class="text-xs font-bold">{{ __('messages.area') }}</label><input type="number" name="area" value="{{ $property->area }}" class="w-full rounded-lg border-gray-300"></div>
                                <div><label class="text-xs font-bold">{{ __('messages.year_built') }}</label><input type="number" name="year_built" value="{{ $property->year_built }}" class="w-full rounded-lg border-gray-300"></div>
                            </div>
                            
                            <h3 class="text-lg font-bold text-graphite mb-4 border-b pb-2 mt-6">{{ __('messages.location') }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="city" value="{{ $property->city }}" class="w-full rounded-lg border-gray-300">
                                <input type="text" name="address" value="{{ $property->address }}" class="w-full rounded-lg border-gray-300">
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-graphite mb-4">{{ __('messages.current_cover') }}</h3>
                            @if($property->cover_image)
                                <img src="{{ Storage::url($property->cover_image) }}" class="w-full h-48 object-cover rounded-lg mb-4 shadow-sm">
                            @endif
                            
                            <label class="block text-sm font-medium text-accent mb-2">{{ __('messages.change_cover') }}</label>
                            <input type="file" name="cover_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-accent file:text-white hover:file:bg-accent/90">
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-graphite mb-4">{{ __('messages.gallery_label') }}</h3>
                            
                            @if($property->images && count($property->images) > 0)
                                <div class="grid grid-cols-2 gap-2 mb-4">
                                    @foreach($property->images as $img)
                                        <div class="relative group">
                                            <img src="{{ Storage::url($img) }}" class="w-full h-24 object-cover rounded-lg">
                                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-lg">
                                                <label class="flex items-center gap-1 text-white text-xs cursor-pointer">
                                                    <input type="checkbox" name="delete_images[]" value="{{ $img }}" class="text-red-500 rounded focus:ring-red-500">
                                                    {{ __('messages.delete_selected') }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-xs text-gray-400 mb-4">{{ __('messages.delete_hint') }}</p>
                            @endif

                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.add_photos') }}</label>
                            <input type="file" name="images[]" multiple accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-700">
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.video_label') }}</label>
                                <input type="url" name="video_url" value="{{ old('video_url', $property->video_url) }}" class="w-full rounded-lg border-gray-300">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.whatsapp_label') }}</label>
                                <input type="text" name="whatsapp" value="{{ old('whatsapp', $property->whatsapp) }}" class="w-full rounded-lg border-gray-300">
                            </div>
                        </div>

                        <div class="bg-gray-800 p-6 rounded-xl shadow-lg text-white">
                            <h3 class="text-lg font-bold mb-4 border-b border-gray-600 pb-2">{{ __('messages.visibility_card') }}</h3>
                            <div class="flex items-start mb-4">
                                <div class="flex h-5 items-center">
                                    <input id="is_exclusive" name="is_exclusive" type="checkbox" value="1" {{ $property->is_exclusive ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-600 bg-gray-700 text-accent focus:ring-accent">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_exclusive" class="font-medium text-white">{{ __('messages.exclusive_label') }}</label>
                                    <p class="text-gray-400">{{ __('messages.exclusive_text') }}</p>
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-accent hover:bg-accent/90 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-all transform hover:scale-105">
                                {{ __('messages.save_changes') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>