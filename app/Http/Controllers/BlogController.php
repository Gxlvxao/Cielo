<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // 1. Query Base Limpa (Usando os Scopes do Model)
        $query = Post::published()
                     ->search($request->input('search'))
                     ->latest('published_at');

        // 2. Lógica do Destaque (Hero)
        // Apenas removemos o destaque se estivermos na página 1 e sem busca
        $featuredPost = null;
        if ($request->missing('search') && $request->input('page', 1) == 1) {
            $featuredPost = $query->first();

            // Se encontrou um destaque, remove ele da listagem principal para não duplicar
            if ($featuredPost) {
                $query->where('id', '!=', $featuredPost->id);
            }
        }

        // 3. Paginação
        $posts = $query->paginate(9)->withQueryString();

        return view('blog.index', compact('posts', 'featuredPost'));
    }

    // O Laravel resolve o 'slug' automaticamente graças ao getRouteKeyName() no Model
    public function show(Post $post)
    {
        // Garantia de Segurança: Se tentarem acessar um post agendado/futuro pelo link direto
        if ($post->published_at > now()) {
            abort(404);
        }

        // Artigos Relacionados (Mesma categoria, exceto o atual)
        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->category($post->category) // Scope reutilizável
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}