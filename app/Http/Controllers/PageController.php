<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Post; // <--- Importante: Importar o Model Post
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Home: A "capa" do site
    public function home()
    {
        // 1. Imóveis "Energia da Semana"
        // Busca imóveis ativos marcados como destaque energético
        $energyProperties = Property::where('status', 'active')
            ->where('is_energy_highlight', true)
            ->latest()
            ->take(4)
            ->get();

        // Se não tiver destaques específicos, pega os últimos ativos normais para não quebrar o layout
        if ($energyProperties->isEmpty()) {
            $energyProperties = Property::where('status', 'active')
                ->where('is_exclusive', false)
                ->latest()
                ->take(3)
                ->get();
        }

        // 2. Artigos do Jornal Cielo (Blog)
        // Busca os 4 últimos posts publicados (1 Destaque + 3 Lista)
        $posts = Post::where('is_published', true)
            ->latest('published_at')
            ->take(4)
            ->get();

        // Retorna a view Cielo com os dados
        return view('cielo.home', compact('energyProperties', 'posts'));
    }

    public function about()
    {
        return view('cielo.pages.about');
    }

    public function contact()
    {
        return view('cielo.pages.contact');
    }

    // Redirecionamentos ou views legadas
    public function services() 
    { 
        return redirect()->route('home'); // Redireciona services antigos para home por enquanto
    }

    public function sell() 
    { 
        return view('pages.sell'); // Mantém página de venda antiga se necessário
    }
}