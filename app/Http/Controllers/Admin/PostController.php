<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:arquitetura,estilo_vida,feng_shui,mercado_luxo',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->only(['title', 'category', 'content', 'published_at']);
        
        // 1. Gera Slug único
        $data['slug'] = Str::slug($request->title) . '-' . now()->format('Ymd');
        
        // 2. Define Author
        $data['user_id'] = auth()->id();
        
        // 3. Define Destaque
        $data['is_featured'] = $request->has('is_featured');

        // 4. GERA O RESUMO AUTOMÁTICO (CORREÇÃO DO ERRO)
        // Pega o conteúdo, remove tags HTML e corta em 150 caracteres
        $data['summary'] = Str::limit(strip_tags($request->content), 150);

        // 5. Upload da Imagem
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Artigo publicado com sucesso!');
    }
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:arquitetura,estilo_vida,feng_shui,mercado_luxo',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->only(['title', 'category', 'content', 'published_at']);
        $data['is_featured'] = $request->has('is_featured');
        
        // Atualiza o resumo automaticamente ao editar
        $data['summary'] = Str::limit(strip_tags($request->content), 150);

        if ($request->hasFile('image')) {
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Artigo atualizado!');
    }

    public function destroy(Post $post)
    {
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Artigo removido.');
    }
}