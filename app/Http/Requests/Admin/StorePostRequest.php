<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Garante que só quem tem permissão pode criar (Admin)
        // Você pode usar o Gate aqui depois
        return true; 
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'string', 'in:arquitetura,estilo_vida,feng_shui,mercado_luxo'], // As categorias do sitemap
            'content'      => ['required', 'string'],
            'image'        => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'], // Max 2MB
            'published_at' => ['nullable', 'date'],
            'is_featured'  => ['boolean'],
        ];
    }
    
    public function messages()
    {
        return [
            'category.in' => 'A categoria selecionada é inválida. Escolha entre: Arquitetura, Estilo de Vida, Feng Shui ou Mercado de Luxo.',
        ];
    }
}