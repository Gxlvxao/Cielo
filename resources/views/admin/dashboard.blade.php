<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="text-2xl font-bold text-cielo-dark leading-tight pl-2">
                Dashboard
            </h2>
            
            <a href="{{ route('properties.create') }}" class="inline-flex items-center gap-2 bg-cielo-dark text-white text-xs font-bold uppercase tracking-widest py-3 px-6 rounded-full hover:bg-cielo-terracotta transition-all duration-300 shadow-lg shadow-cielo-dark/10 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Property
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        
        <div class="bg-white p-8 border border-cielo-dark/5 shadow-lg shadow-cielo-dark/5 rounded-3xl relative overflow-hidden group hover:border-cielo-terracotta/30 transition-all duration-300">
            <h3 class="text-[10px] font-bold uppercase tracking-widest text-cielo-navy/60 mb-3">Pending Requests</h3>
            <div class="flex items-end justify-between">
                <span class="text-5xl font-bold text-cielo-dark tracking-tight">{{ $stats['pending_requests'] }}</span>
                
                @if($stats['pending_requests'] > 0)
                    <div class="flex items-center gap-2 text-xs font-bold text-cielo-terracotta bg-cielo-terracotta/10 px-3 py-1.5 rounded-full">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cielo-terracotta opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-cielo-terracotta"></span>
                        </span>
                        Action Needed
                    </div>
                @else
                    <span class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1.5 rounded-full">All Clear</span>
                @endif
            </div>
        </div>

        <div class="bg-white p-8 border border-cielo-dark/5 shadow-lg shadow-cielo-dark/5 rounded-3xl transition-all duration-300">
            <h3 class="text-[10px] font-bold uppercase tracking-widest text-cielo-navy/60 mb-3">Properties Review</h3>
            <div class="flex items-end justify-between">
                <span class="text-5xl font-bold text-cielo-dark tracking-tight">{{ $stats['pending_properties'] }}</span>
                <span class="text-xs font-medium text-cielo-navy/40 bg-gray-50 px-3 py-1.5 rounded-full">Total: {{ $stats['total_properties'] }}</span>
            </div>
        </div>

        <div class="bg-white p-8 border border-cielo-dark/5 shadow-lg shadow-cielo-dark/5 rounded-3xl transition-all duration-300">
            <h3 class="text-[10px] font-bold uppercase tracking-widest text-cielo-navy/60 mb-3">Active Listings</h3>
            <div class="flex items-end justify-between">
                <span class="text-5xl font-bold text-cielo-dark tracking-tight">{{ $stats['published_properties'] }}</span>
                <span class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1.5 rounded-full">Live</span>
            </div>
        </div>

        <div class="bg-white p-8 border border-cielo-dark/5 shadow-lg shadow-cielo-dark/5 rounded-3xl transition-all duration-300">
            <h3 class="text-[10px] font-bold uppercase tracking-widest text-cielo-navy/60 mb-3">Total Users</h3>
            <div class="flex items-end justify-between">
                <span class="text-5xl font-bold text-cielo-dark tracking-tight">{{ $stats['total_users'] }}</span>
                <div class="text-right flex flex-col items-end gap-1">
                    <span class="text-[10px] font-medium bg-gray-50 px-2 py-0.5 rounded-full text-cielo-navy/50">{{ $stats['clients'] }} Clients</span>
                    <span class="text-[10px] font-medium bg-gray-50 px-2 py-0.5 rounded-full text-cielo-navy/50">{{ $stats['developers'] }} Devs</span>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="bg-white border border-cielo-dark/5 shadow-lg shadow-cielo-dark/5 rounded-3xl overflow-hidden">
            <div class="p-8 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-cielo-dark tracking-tight">Recent Access Requests</h3>
                <a href="{{ route('admin.access-requests') }}" class="text-[10px] font-bold uppercase tracking-widest text-cielo-terracotta hover:bg-cielo-terracotta/10 px-3 py-1.5 rounded-full transition-colors">
                    View All
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-cielo-cream/50 text-cielo-navy/60 uppercase tracking-widest text-[10px] font-medium">
                        <tr>
                            <th class="px-8 py-4 first:rounded-tl-2xl">Name</th>
                            <th class="px-8 py-4">Type</th>
                            <th class="px-8 py-4 text-right last:rounded-tr-2xl">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentRequests as $req)
                            <tr class="hover:bg-gray-50 transition-colors cursor-pointer group" onclick="window.location='{{ route('admin.access-requests.show', $req->id) }}'">
                                <td class="px-8 py-5 font-bold text-cielo-dark group-hover:text-cielo-terracotta transition-colors">{{ $req->name }}</td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-cielo-navy/70 border border-gray-200">
                                        {{ ucfirst($req->investor_type) }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right text-xs font-medium text-cielo-navy/40">{{ $req->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-8 py-10 text-center text-gray-400 text-xs italic">No pending requests at the moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white border border-cielo-dark/5 shadow-lg shadow-cielo-dark/5 rounded-3xl overflow-hidden">
            <div class="p-8 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-cielo-dark tracking-tight">Recent Properties</h3>
                <a href="{{ route('admin.properties') }}" class="text-[10px] font-bold uppercase tracking-widest text-cielo-terracotta hover:bg-cielo-terracotta/10 px-3 py-1.5 rounded-full transition-colors">
                    Manage Properties
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-cielo-cream/50 text-cielo-navy/60 uppercase tracking-widest text-[10px] font-medium">
                        <tr>
                            <th class="px-8 py-4 first:rounded-tl-2xl">Title</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4 text-right last:rounded-tr-2xl">Price</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentProperties as $prop)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-8 py-5 font-bold text-cielo-dark truncate max-w-[200px]">{{ $prop->title }}</td>
                                <td class="px-8 py-5">
                                    @php
                                        $statusClasses = match($prop->status) {
                                            'active' => 'bg-green-50 text-green-700 border border-green-100',
                                            'pending_review' => 'bg-yellow-50 text-yellow-700 border border-yellow-100',
                                            'draft' => 'bg-gray-50 text-gray-600 border border-gray-100',
                                            default => 'bg-gray-50 text-gray-600 border border-gray-100'
                                        };
                                    @endphp
                                    <span class="px-3 py-1 text-[10px] uppercase tracking-wide rounded-full font-bold {{ $statusClasses }}">
                                        {{ str_replace('_', ' ', $prop->status) }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right text-cielo-dark font-bold text-lg">{{ number_format($prop->price, 0, ',', '.') }} €</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-8 py-10 text-center text-gray-400 text-xs italic">No properties listed yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>