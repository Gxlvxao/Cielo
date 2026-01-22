<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Inicia a query (supondo que você tenha o scope 'published' ou use where)
        // Se não tiver o scope no Model, troque por: Post::where('status', 'published')
        $query = Post::where('status', 'published'); 

        // 1. Lógica de Busca (Search)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Ordenação
        $query->latest('published_at');

        // 2. Lógica do Destaque (Apenas na página 1 e sem busca ativa)
        $featuredPost = null;
        if (!$request->filled('search') && ($request->input('page', 1) == 1)) {
            $featuredPost = $query->first(); // Pega o mais recente para ser o Hero
            
            if ($featuredPost) {
                $query->where('id', '!=', $featuredPost->id); // Remove ele da lista de baixo
            }
        }

        // Paginação dos "demais blogs menores"
        $posts = $query->paginate(9)->withQueryString();

        // Verifique se o arquivo está em resources/views/blog/index.blade.php
        return view('blog.index', compact('posts', 'featuredPost'));
    }

    public function show($slug)
    {
        // Busca pelo slug
        $post = Post::where('status', 'published')
                    ->where('slug', $slug)
                    ->firstOrFail();
        
        // 3. Artigos Relacionados (Mesma categoria, exceto o atual)
        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where(function($q) use ($post) {
                // Tenta pegar da mesma categoria/tag se existir, senão pega aleatório
                if ($post->category) {
                    $q->where('category', $post->category);
                }
            })
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Passamos como 'relatedPosts' para bater com a view que eu te mandei antes
        return view('blog.show', compact('post', 'relatedPosts'));
    }
}