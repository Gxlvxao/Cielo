<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Post; // <--- Importante: Importar o Model Post
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Home: A "capa" do site
    public function home()
    {
        // 1. Imóveis "Energia da Semana"
        // Busca imóveis ativos. Se tiver o campo 'is_energy_highlight', prioriza.
        $energyProperties = Property::where('status', 'active')
            ->where('is_energy_highlight', true) // Tenta pegar os destaques energéticos primeiro
            ->latest()
            ->take(4)
            ->get();

        // Fallback: Se não houver destaques marcados, traz os mais recentes normais
        if ($energyProperties->isEmpty()) {
            $energyProperties = Property::where('status', 'active')
                ->where('is_exclusive', false) // Evita mostrar off-market na home se não for intencional
                ->latest()
                ->take(4)
                ->get();
        }

        // 2. Artigos do Jornal Cielo (Blog)
        // Busca os 4 posts: Publicados (Data válida) + Ordenados por Destaque e Data
        $posts = Post::query()
            ->with('user') // Eager Loading: Carrega o autor
            ->whereNotNull('published_at')       // Garante que tem data definida
            ->where('published_at', '<=', now()) // Garante que a data já chegou (não é futuro)
            ->orderByDesc('is_featured')         // 1º Critério: É destaque?
            ->orderByDesc('published_at')        // 2º Critério: Mais recente
            ->take(4)                            // Pega 4 (1 Destaque + 3 Grid)
            ->get();

        // Retorna a view Cielo com os dados
        return view('cielo.home', compact('energyProperties', 'posts'));
    }

    public function about()
    {
        // Verifica se existe a view personalizada, senão usa a padrão
        if (view()->exists('cielo.pages.about')) {
            return view('cielo.pages.about');
        }
        return view('pages.about'); // Nossa view atual criada anteriormente
    }

    public function contact()
    {
        if (view()->exists('cielo.pages.contact')) {
            return view('cielo.pages.contact');
        }
        return view('pages.contact'); // Nossa view atual
    }

    // Redirecionamentos ou views legadas
    public function services() 
    { 
        // Se você tiver a view 'pages.services', pode retornar ela aqui:
        if (view()->exists('pages.services')) {
            return view('pages.services');
        }
        return redirect()->route('home'); 
    }

    public function sell() 
    { 
        if (view()->exists('pages.sell')) {
            return view('pages.sell');
        }
        return redirect()->route('home');
    }
}