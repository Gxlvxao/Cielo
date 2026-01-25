<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Post; 
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Home: O Portal de Harmonia (Capa do Site)
    public function home()
    {
        // 1. IMÓVEIS "ENERGIA DA SEMANA"
        // Tenta buscar 3 destaques ativos (3 é o número ideal para o Grid do layout)
        $properties = Property::where('status', 'active')
            ->where('is_energy_of_week', true) // Nome correto da coluna no DB
            ->latest()
            ->take(3)
            ->get();

        // LÓGICA DE PREENCHIMENTO INTELIGENTE (SMART FALLBACK)
        // Se houver menos de 3 destaques, completamos com os imóveis mais recentes
        // para garantir que a home page nunca fique com buracos vazios.
        if ($properties->count() < 3) {
            $needed = 3 - $properties->count();
            
            // Pega os IDs que já temos para não repetir
            $existingIds = $properties->pluck('id')->toArray();

            $recents = Property::where('status', 'active')
                ->whereNotIn('id', $existingIds) // Exclui os que já pegamos
                ->where('is_exclusive', false)   // Garante que são públicos
                ->latest()
                ->take($needed)
                ->get();

            // Funde as duas coleções
            $properties = $properties->merge($recents);
        }

        // 2. JORNAL CIELO (BLOG)
        // Busca os 3 posts mais recentes para o rodapé ou seção de blog
        $posts = Post::query()
            ->with('user') // Carrega o autor para evitar N+1 queries
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('is_featured')
            ->orderByDesc('published_at')
            ->take(3) 
            ->get();

        // Verifica qual view carregar (prioriza a view "cielo" se existir)
        $viewName = view()->exists('cielo.home') ? 'cielo.home' : 'home';

        return view($viewName, compact('properties', 'posts'));
    }

    public function about()
    {
        if (view()->exists('cielo.pages.about')) {
            return view('cielo.pages.about');
        }
        return view('pages.about');
    }

    public function contact()
    {
        if (view()->exists('cielo.pages.contact')) {
            return view('cielo.pages.contact');
        }
        return view('pages.contact');
    }

    // Redirecionamentos para manter a integridade se alguém acessar links antigos
    public function services() 
    { 
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

    public function recruitment()
    {
        return view('pages.recruitment');
    }

    // Página de Parceiros
    public function partners()
    {
        return view('pages.partners');
    }
    
}