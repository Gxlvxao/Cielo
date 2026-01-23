<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Chatbot\ChatbotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    /**
     * Endpoint principal que processa a mensagem e retorna Texto + Áudio.
     */
    public function sendMessage(Request $request, ChatbotService $bot)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'history' => 'array|nullable',
            'history.*.role' => 'in:user,assistant,system,tool',
            'history.*.content' => 'nullable|string',
        ]);

        try {
            // CORREÇÃO: Nome do Cookie atualizado para 'cielo_locale'
            $locale = session('locale', $request->cookie('cielo_locale', config('app.locale')));

            $history = $validated['history'] ?? [];

            $response = $bot->handleMessage(
                $validated['message'],
                $locale,
                $history
            );

            return response()->json([
                'status' => 'success',
                'reply'  => $response['reply'],
                'audio'  => $response['audio'], 
                'data'   => $response['data']   
            ]);

        } catch (\Exception $e) {
            Log::error('Cielo Chatbot Error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Desculpe, estou processando muita informação agora. Tente novamente em instantes.'
            ], 500);
        }
    }
}