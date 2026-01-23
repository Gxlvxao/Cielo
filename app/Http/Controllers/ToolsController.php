<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CapitalGainsCalculatorService;
use Illuminate\Support\Facades\Log;

class ToolsController extends Controller
{
    protected $calculator;

    public function __construct(CapitalGainsCalculatorService $calculator)
    {
        $this->calculator = $calculator;
    }

    // --- VIEWS ---
    public function showGainsSimulator() { return view('tools.gains'); }
    public function showCreditSimulator() { return view('tools.credit'); }
    public function showImtSimulator() { return view('tools.imt'); }

    // --- API / ACTIONS ---

    // 1. Mais-Valias (Cálculo no Back-End porque é complexo)
    public function calculateGains(Request $request)
    {
        // Validação (Simplificada para não travar o teste)
        $validated = $request->validate([
            'acquisition_value' => 'required|numeric',
            'sale_value' => 'required|numeric',
            'acquisition_year' => 'required|integer',
            // Adicione os outros campos conforme necessário
            'lead_email' => 'required|email'
        ]);

        // Cálculo via Service
        $results = $this->calculator->calculate($request->all());

        // TODO: Enviar Email com PDF (Pendente configuração SMTP)
        // Mail::to($request->lead_email)->queue(new GainsSimulationMail($results));

        return response()->json($results);
    }

    // 2. IMT (Cálculo no Front, apenas recebe Lead)
    public function sendImtLead(Request $request)
    {
        $request->validate([
            'lead_name' => 'required|string',
            'lead_email' => 'required|email',
            'totalPayable' => 'required|numeric'
        ]);

        // Log para debug
        Log::info('Lead IMT Recebido', $request->all());

        // Retorna sucesso para o Alpine.js não dar erro
        return response()->json(['message' => 'Simulação enviada com sucesso!']);
    }

    // 3. Crédito (Cálculo no Front, apenas recebe Lead)
    public function sendCreditLead(Request $request)
    {
        $request->validate([
            'lead_name' => 'required|string',
            'lead_email' => 'required|email',
            'monthlyPayment' => 'required|numeric'
        ]);

        Log::info('Lead Crédito Recebido', $request->all());

        return response()->json(['message' => 'Pedido de análise recebido!']);
    }
}