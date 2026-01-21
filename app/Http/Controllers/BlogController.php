<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Grid do Jornal
        $posts = Post::published()
            ->latest('published_at')
            ->paginate(9);

        return view('cielo.blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();
        
        // Sugerir leitura de outros posts da mesma categoria
        $related = Post::published()
            ->where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        return view('cielo.blog.show', compact('post', 'related'));
    }
}