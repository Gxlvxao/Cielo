<x-public-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900 prose max-w-none">
                    <h1 class="text-3xl font-bold mb-6 text-crow-primary">{{ $title }}</h1>
                    
                    <div class="space-y-4 text-justify">
                        {!! $content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>