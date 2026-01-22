<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class BlogService
{
    /**
     * Cria um novo post no banco de dados.
     */
    public function createPost(array $data, ?UploadedFile $image): Post
    {
        return DB::transaction(function () use ($data, $image) {
            
            // 1. Geração do Slug (SEO Friendly)
            $data['slug'] = Str::slug($data['title']) . '-' . now()->timestamp;

            // 2. Upload da Imagem (Capa)
            if ($image) {
                // Salva em storage/app/public/blog
                $path = $image->store('blog', 'public');
                $data['image_path'] = $path;
            }

            // 3. Define autor (assumindo usuário logado ou sistema)
            $data['user_id'] = auth()->id();

            // 4. Tratamento de checkbox HTML (vem 'on' ou null, forçamos boolean)
            $data['is_published'] = isset($data['published_at']); // Se tem data, está publicado
            
            return Post::create($data);
        });
    }

    /**
     * Atualiza um post existente.
     */
    public function updatePost(Post $post, array $data, ?UploadedFile $image): Post
    {
        return DB::transaction(function () use ($post, $data, $image) {
            
            if ($image) {
                // Remove imagem antiga se existir para não acumular lixo
                if ($post->image_path && Storage::disk('public')->exists($post->image_path)) {
                    Storage::disk('public')->delete($post->image_path);
                }
                $data['image_path'] = $image->store('blog', 'public');
            }

            // Se mudou o título, podemos optar por regerar o slug ou manter o antigo (SEO prefere manter)
            // Aqui vou manter o slug original para não quebrar links externos.

            $post->update($data);
            return $post;
        });
    }
}