<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Property::query();

        // Base filter: show published properties
        $query->where('status', 'published');

        // If user is not authenticated, hide exclusive properties
        if (!Auth::check()) {
            $query->where('is_exclusive', false);
        }

        // Apply filters
        if ($request->filled('city')) {
            $query->byCity($request->city);
        }

        if ($request->filled('type')) {
            $query->byType($request->type);
        }

        if ($request->filled('transaction_type')) {
            $query->byTransactionType($request->transaction_type);
        }

        if ($request->filled('bedrooms')) {
            $query->byBedrooms($request->bedrooms);
        }

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->byPriceRange($request->min_price, $request->max_price);
        }

        // Order by featured first, then by newest
        $query->orderBy('is_featured', 'desc')
              ->orderBy('published_at', 'desc');

        $properties = $query->paginate(12);

        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if user can manage properties
        if (!Auth::user()->canManageProperties()) {
            abort(403, 'Você não tem permissão para adicionar imóveis.');
        }

        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if user can manage properties
        if (!Auth::user()->canManageProperties()) {
            abort(403, 'Você não tem permissão para adicionar imóveis.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:apartment,house,land,commercial',
            'transaction_type' => 'required|in:sale,rent',
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
            'features' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_exclusive' => 'nullable|boolean',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $imagePaths[] = $path;
            }
        }

        $validated['images'] = $imagePaths;
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'published';
        $validated['published_at'] = now();
        $validated['is_exclusive'] = $request->boolean('is_exclusive');

        $property = Property::create($validated);

        return redirect()->route('properties.show', $property)
            ->with('success', 'Imóvel adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        // Check if property is exclusive and user is not authenticated
        if ($property->is_exclusive && !Auth::check()) {
            abort(403, 'Este imóvel é exclusivo para membros.');
        }

        // Check if property is published or user is the owner/admin
        if (!$property->isPublished() && (!Auth::check() || (Auth::id() !== $property->user_id && !Auth::user()->isAdmin()))) {
            abort(404);
        }

        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        // Check if user can edit this property
        if (!Auth::user()->canManageProperties() || (Auth::id() !== $property->user_id && !Auth::user()->isAdmin())) {
            abort(403, 'Você não tem permissão para editar este imóvel.');
        }

        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        // Check if user can edit this property
        if (!Auth::user()->canManageProperties() || (Auth::id() !== $property->user_id && !Auth::user()->isAdmin())) {
            abort(403, 'Você não tem permissão para editar este imóvel.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:apartment,house,land,commercial',
            'transaction_type' => 'required|in:sale,rent',
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
            'features' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_exclusive' => 'nullable|boolean',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            // Delete old images
            if ($property->images) {
                foreach ($property->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties', 'public');
                $imagePaths[] = $path;
            }
            $validated['images'] = $imagePaths;
        }

        $validated['is_exclusive'] = $request->boolean('is_exclusive');

        $property->update($validated);

        return redirect()->route('properties.show', $property)
            ->with('success', 'Imóvel atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        // Check if user can delete this property
        if (!Auth::user()->canManageProperties() || (Auth::id() !== $property->user_id && !Auth::user()->isAdmin())) {
            abort(403, 'Você não tem permissão para excluir este imóvel.');
        }

        // Delete images
        if ($property->images) {
            foreach ($property->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $property->delete();

        return redirect()->route('properties.index')
            ->with('success', 'Imóvel excluído com sucesso!');
    }

    /**
     * Display user's properties (for developers)
     */
    public function myProperties()
    {
        if (!Auth::user()->canManageProperties()) {
            abort(403, 'Você não tem permissão para acessar esta página.');
        }

        $properties = Property::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('properties.my-properties', compact('properties'));
    }
}
