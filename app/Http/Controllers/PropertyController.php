<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\VisitRequestMail;
use App\Mail\PropertyApprovedMail;

class PropertyController extends Controller
{
    // ==========================================
    // ÁREA PÚBLICA (FRONT-END CIELO)
    // ==========================================

    public function index(Request $request)
    {
        // Query base: Apenas ativos e NÃO exclusivos (públicos)
        $query = Property::where('status', 'active')
                         ->where('is_exclusive', false);

        // 1. Filtro de Palavra-Chave (Search Bar do Header)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        // 2. Filtros Específicos (Sidebar/Advanced)
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        
        if ($request->filled('location')) { // Compatibilidade com o select do header
            $query->where('city', $request->location);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Ordenação: Destaques primeiro, Destaque Energético, depois Recentes
        $query->orderBy('is_featured', 'desc')
              ->orderBy('is_energy_highlight', 'desc') // Novo campo Cielo
              ->orderBy('published_at', 'desc');
              
        $properties = $query->paginate(12)->withQueryString();

        // RETORNA A VIEW (Caminho corrigido para evitar erro)
        return view('properties.index', compact('properties'));
    }

    public function show(Property $property)
    {
        // Verifica permissão (Admin e Dono veem tudo)
        $canView = false;

        if (Auth::check() && (Auth::id() === $property->user_id || Auth::user()->isAdmin())) {
            $canView = true;
        } elseif ($property->status === 'active') {
            // Lógica para verificação de exclusivos vs públicos
            if ($property->is_exclusive) {
                // Se for exclusivo, verifica se user tem permissão
                // Por enquanto, se está logado e ativo, permitimos (ajuste conforme regra de negócio)
                if (Auth::check()) {
                   $canView = true; 
                }
            } else {
                $canView = true; // Público e ativo
            }
        }

        if (!$canView) {
            abort(403, 'Acesso restrito ou imóvel indisponível.');
        }

        // RETORNA A VIEW SINGLE (Caminho corrigido)
        return view('properties.show', compact('property'));
    }

    // ==========================================
    // ÁREA PRIVADA (COLLECTION PRIVÉE)
    // ==========================================

    public function offMarket(Request $request)
    {
        // Apenas imóveis exclusivos e ativos
        $query = Property::where('status', 'active')
                         ->where('is_exclusive', true);

        // Filtros básicos
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        
        $properties = $query->latest('published_at')->paginate(9);

        // View específica para Off-Market
        // Obs: Se esta view ainda não existir, crie resources/views/properties/off-market.blade.php
        return view('properties.off-market', compact('properties'));
    }

    // ==========================================
    // GESTÃO (ADMIN / DEVELOPER)
    // ==========================================

    public function create()
    {
        if (!Auth::user()->canManageProperties()) abort(403);
        return view('properties.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->canManageProperties()) abort(403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'type' => 'required|in:apartment,house,villa,land,commercial,office',
            'transaction_type' => 'required|in:sale,rent',
            'condition' => 'nullable|in:new,used,renovated,under_construction',
            'price' => 'required|numeric|min:0',
            'city' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'nullable|numeric|min:0',
            'land_area' => 'nullable|numeric|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . date('Y'),
            'energy_rating' => 'nullable|string|max:5',
            'video_url' => ['nullable', 'url', 'regex:/(youtube\.com|youtu\.be|vimeo\.com)/'],
            'whatsapp' => 'nullable|string|max:20',
            'features' => 'nullable|array',
            'is_exclusive' => 'nullable|boolean',
            'is_energy_highlight' => 'nullable|boolean', // Novo campo
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('properties/covers', 'public');
        }

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('properties/gallery', 'public');
            }
        }
        $validated['images'] = $imagePaths;
        $validated['user_id'] = Auth::id();
        $isAdmin = Auth::user()->isAdmin();
        $validated['status'] = $isAdmin ? 'active' : 'pending_review';
        $validated['published_at'] = now();
        $validated['is_exclusive'] = $request->boolean('is_exclusive');
        $validated['is_energy_highlight'] = $request->boolean('is_energy_highlight');

        $property = Property::create($validated);

        $msg = $isAdmin ? 'Imóvel publicado com sucesso!' : 'Imóvel enviado para aprovação.';
        
        return redirect()->route('properties.edit', $property)->with('success', $msg);
    }

    public function edit(Property $property)
    {
        if (!Auth::user()->canManageProperties() || (Auth::id() !== $property->user_id && !Auth::user()->isAdmin())) abort(403);
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        if (!Auth::user()->canManageProperties() || (Auth::id() !== $property->user_id && !Auth::user()->isAdmin())) abort(403);

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'type' => 'required|in:apartment,house,villa,land,commercial,office',
            'transaction_type' => 'required|in:sale,rent',
            'condition' => 'nullable|in:new,used,renovated,under_construction',
            'price' => 'required|numeric|min:0',
            'city' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'nullable|numeric|min:0',
            'land_area' => 'nullable|numeric|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . date('Y'),
            'energy_rating' => 'nullable|string|max:5',
            'video_url' => ['nullable', 'url', 'regex:/(youtube\.com|youtu\.be|vimeo\.com)/'],
            'whatsapp' => 'nullable|string|max:20',
            'features' => 'nullable|array',
            'is_exclusive' => 'nullable|boolean',
            'is_energy_highlight' => 'nullable|boolean',
            'delete_images' => 'nullable|array',
            'status' => 'required|in:draft,active,negotiating,sold,pending_review'
        ];

        $validated = $request->validate($rules);

        if (!Auth::user()->isAdmin()) {
             $validated['status'] = 'pending_review';
        }

        if ($request->hasFile('cover_image')) {
            if ($property->cover_image) Storage::disk('public')->delete($property->cover_image);
            $validated['cover_image'] = $request->file('cover_image')->store('properties/covers', 'public');
        }

        $currentImages = $property->images ?? [];
        if ($request->filled('delete_images')) {
            foreach ($request->delete_images as $imageToDelete) {
                if (($key = array_search($imageToDelete, $currentImages)) !== false) {
                    Storage::disk('public')->delete($imageToDelete);
                    unset($currentImages[$key]);
                }
            }
            $currentImages = array_values($currentImages);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $currentImages[] = $image->store('properties/gallery', 'public');
            }
        }
        $validated['images'] = $currentImages;
        $validated['is_exclusive'] = $request->boolean('is_exclusive');
        $validated['is_energy_highlight'] = $request->boolean('is_energy_highlight');

        $property->update($validated);

        return redirect()->back()->with('success', 'Imóvel atualizado!');
    }

    public function destroy(Property $property)
    {
        if (!Auth::user()->canManageProperties() || (Auth::id() !== $property->user_id && !Auth::user()->isAdmin())) abort(403);
        
        if ($property->cover_image) Storage::disk('public')->delete($property->cover_image);
        if ($property->images) {
            foreach ($property->images as $image) Storage::disk('public')->delete($image);
        }
        
        $property->delete();
        return redirect()->route('properties.my')->with('success', 'Imóvel excluído!');
    }

    // ==========================================
    // MÉTODOS AUXILIARES
    // ==========================================
    
    public function approve(Property $property)
    {
       if (!Auth::user() || !Auth::user()->isAdmin()) abort(403);
       $property->update(['status' => 'active']);
       try {
           if ($property->user) {
               Mail::to($property->user->email)->send(new PropertyApprovedMail($property));
           }
       } catch (\Exception $e) {
           Log::error('Erro email: ' . $e->getMessage());
       }
       return back()->with('success', 'Imóvel aprovado!');
    }

    public function reject(Property $property)
    {
       if (!Auth::user() || !Auth::user()->isAdmin()) abort(403);
       $property->update(['status' => 'draft']); 
       return back()->with('success', 'Imóvel rejeitado.');
    }

    public function myProperties()
    {
       if (!Auth::user()->canManageProperties()) abort(403);
       $properties = Property::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(12);
       return view('properties.my-properties', compact('properties'));
    }

    public function sendVisitRequest(Request $request, Property $property)
    {
       $validated = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email',
           'phone' => 'required|string|max:20',
           'preferred_date' => 'required|string',
           'message' => 'nullable|string',
       ]);
       
       $recipient = $property->user->email ?? 'admin@crow-global.com';
       try {
           Mail::to($recipient)->cc('admin@crow-global.com')->send(new VisitRequestMail($property, $validated));
       } catch (\Exception $e) {
           return redirect()->back()->with('error', 'Erro ao enviar. Tente WhatsApp.');
       }
       return redirect()->back()->with('success', 'Solicitação enviada!');
    }

    public function getAccessList(Property $property)
    {
       if (!Auth::user()->canManageProperties()) abort(403);
       $clients = (Auth::user()->isAdmin()) 
           ? User::where('role', 'client')->orderBy('name')->get()
           : User::where('developer_id', Auth::id())->orderBy('name')->get();
       $allowedIds = $property->allowedUsers()->pluck('users.id')->toArray();
       return response()->json(['clients' => $clients, 'allowed_ids' => $allowedIds]);
    }
}