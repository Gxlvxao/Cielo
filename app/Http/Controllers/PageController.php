<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Home: Apenas a "capa" do site
    public function home()
    {
        // Busca 3 imóveis destaque para o "teaser" na home
        $featuredProperties = Property::where('status', 'active')
            ->where('is_exclusive', false)
            ->orderBy('is_featured', 'desc')
            ->latest()
            ->take(3)
            ->get();

        return view('pages.home', compact('featuredProperties'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function sell()
    {
        return view('pages.sell'); // Página de Angariação
    }

    public function contact()
    {
        return view('pages.contact');
    }
}