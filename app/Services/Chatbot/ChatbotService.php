<?php

namespace App\Services\Chatbot;

use OpenAI;
use App\Models\Property;
use App\Models\AccessRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client as GuzzleClient;

class ChatbotService
{
    protected $client;

    public function __construct()
    {
        $apiKey = config('services.openai.key') ?? env('OPENAI_API_KEY');

        if (empty($apiKey)) {
            Log::critical('OpenAI API Key is missing.');
            // Em produção, não lance exceção para não quebrar o site inteiro, apenas logue.
            // Mas para dev, ok lançar.
        }

        $this->client = OpenAI::factory()
            ->withApiKey($apiKey)
            ->withHttpClient(new GuzzleClient([
                'verify' => false, 
                'timeout' => 30,
            ]))
            ->make();
    }

    public function handleMessage(string $message, string $locale, array $history = []): array
    {
        $tools = $this->getToolsDefinition();
        
        // --- PERSONALIDADE CIELO ---
        $systemPrompt = "You are 'Cielo AI', the private real estate concierge for Cielo (a luxury boutique studio in Portugal).
            Current Language: '{$locale}'.
            
            BRAND VOICE:
            - Sophisticated, calm, and professional.
            - We don't just sell houses; we curate lifestyles.
            - Use terms like 'curation', 'harmony', 'private collection' instead of just 'listings'.

            RULES:
            1. Answer exclusively in '{$locale}'.
            2. Be concise but warm.
            3. Use 'search_properties' for buying inquiries.
            4. Use 'submit_sell_lead' for selling inquiries.
            5. Use 'request_off_market_access' ONLY if user asks for exclusive/off-market access.
        ";

        $cleanHistory = array_map(function($msg) {
            return ['role' => $msg['role'], 'content' => $msg['content'] ?? ''];
        }, $history);

        $messages = array_merge(
            [['role' => 'system', 'content' => $systemPrompt]],
            $cleanHistory,
            [['role' => 'user', 'content' => $message]]
        );

        try {
            $response = $this->client->chat()->create([
                'model' => 'gpt-4o-mini', 
                'messages' => $messages,
                'tools' => $tools,
                'tool_choice' => 'auto', 
            ]);

            $choice = $response->choices[0];
            $replyContent = $choice->message->content ?? '';
            $frontendData = null;

            if ($choice->finishReason === 'tool_calls') {
                $messages[] = $choice->message->toArray();

                foreach ($choice->message->toolCalls as $toolCall) {
                    $functionName = $toolCall->function->name;
                    $args = json_decode($toolCall->function->arguments, true);

                    $toolResult = $this->executeFunction($functionName, $args);

                    if ($functionName === 'search_properties' && is_array($toolResult) && isset($toolResult['data'])) {
                        $frontendData = $toolResult['data'];
                        $toolResult = $toolResult['summary'];
                    }

                    $messages[] = [
                        'role' => 'tool',
                        'tool_call_id' => $toolCall->id,
                        'content' => is_string($toolResult) ? $toolResult : json_encode($toolResult)
                    ];
                }

                $finalResponse = $this->client->chat()->create([
                    'model' => 'gpt-4o-mini',
                    'messages' => $messages,
                ]);

                $replyContent = $finalResponse->choices[0]->message->content;
            }

            if (empty($replyContent)) $replyContent = "Entendido."; // Fallback seguro
            $audioBase64 = $this->textToSpeech($replyContent);

            return [
                'reply' => $replyContent,
                'audio' => $audioBase64,
                'data'  => $frontendData
            ];

        } catch (\Exception $e) {
            Log::error("Cielo Chatbot Error: " . $e->getMessage());
            return [
                'reply' => ($locale == 'pt') ? "Estou a calibrar a minha ligação. Tente novamente em breve." : "I am calibrating my connection. Please try again shortly.",
                'audio' => null,
                'data' => null
            ];
        }
    }

    private function textToSpeech(string $text): ?string
    {
        try {
            $textSample = substr($text, 0, 500); 
            $response = $this->client->audio()->speech([
                'model' => 'tts-1', 
                'input' => $textSample,
                'voice' => 'shimmer', // Voz feminina suave, combina com "Cielo"
            ]);
            return base64_encode($response); 
        } catch (\Exception $e) {
            return null; 
        }
    }

    private function executeFunction(string $name, array $args)
    {
        try {
            switch ($name) {
                case 'search_properties':
                    $query = Property::query()
                        ->where('status', 'active')
                        ->where('is_exclusive', false);

                    if (!empty($args['city'])) $query->where('city', 'LIKE', "%{$args['city']}%");
                    
                    if (!empty($args['max_price'])) {
                        $price = preg_replace('/[^0-9]/', '', $args['max_price']);
                        $query->where('price', '<=', $price);
                    }

                    $properties = $query->limit(4)->get();

                    if ($properties->isEmpty()) return "Nenhuma propriedade encontrada nesta curadoria pública.";

                    return [
                        'summary' => "Encontrei " . $properties->count() . " imóveis na nossa coleção.",
                        'data' => $properties->map(function($p) {
                            return [
                                'id' => $p->id,
                                'title' => $p->title ?? 'Imóvel Cielo',
                                'price' => number_format($p->price, 0, ',', '.') . ' €',
                                'image' => $p->cover_image ? asset('storage/' . $p->cover_image) : asset('images/placeholder.jpg'),
                                'link' => route('properties.show', $p->id)
                            ];
                        })
                    ];

                case 'submit_sell_lead':
                    try {
                        // Email genérico de admin ou o definido no .env
                        $adminEmail = config('mail.from.address') ?? 'hello@cielo.com';
                        
                        Mail::raw("Nova Lead de Venda (Cielo AI):\n\nDescrição: {$args['description']}\nContato: {$args['contact']}", function ($msg) use ($adminEmail) {
                            $msg->to($adminEmail)
                                ->subject('💎 Nova Oportunidade de Venda (Cielo)');
                        });
                    } catch (\Exception $e) {
                        Log::error("Mail Error: " . $e->getMessage());
                    }
                    return "Lead recebida e encaminhada para a equipa de curadoria.";

                case 'request_off_market_access':
                    if (AccessRequest::where('email', $args['email'])->exists()) {
                        return "Já existe um pedido pendente para este email.";
                    }

                    AccessRequest::create([
                        'user_id' => auth()->id() ?? null,
                        'name' => $args['name'],
                        'email' => $args['email'],
                        'message' => $args['reason'], 
                        'status' => 'pending',
                        'requested_role' => 'investor', 
                        'country' => 'Portugal',
                        'investor_type' => 'client'
                    ]);
                    
                    return "Pedido submetido ao Private Circle. Aguarde o nosso contacto.";

                default:
                    return "Função desconhecida.";
            }
        } catch (\Exception $e) {
            Log::error("DB Error ($name): " . $e->getMessage());
            return "Erro ao processar pedido.";
        }
    }

    private function getToolsDefinition(): array
    {
        return [
            [
                'type' => 'function',
                'function' => [
                    'name' => 'search_properties',
                    'description' => 'Search properties for sale in the database.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'city' => ['type' => 'string'],
                            'max_price' => ['type' => 'number'],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'submit_sell_lead',
                    'description' => 'User wants to sell a property.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'description' => ['type' => 'string'],
                            'contact' => ['type' => 'string'],
                        ],
                        'required' => ['description', 'contact'],
                    ],
                ],
            ],
            [
                'type' => 'function',
                'function' => [
                    'name' => 'request_off_market_access',
                    'description' => 'User asks for exclusive or off-market access.',
                    'parameters' => [
                        'type' => 'object',
                        'properties' => [
                            'name' => ['type' => 'string'],
                            'email' => ['type' => 'string'],
                            'reason' => ['type' => 'string'],
                        ],
                        'required' => ['name', 'email', 'reason'],
                    ],
                ],
            ],
        ];
    }
}