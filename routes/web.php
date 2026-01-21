<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\BlogController; // <--- NOVO (Vamos criar em breve)
use App\Http\Controllers\Api\ChatbotController;
use App\Http\Controllers\AccessRequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CIELO - ROTAS PÚBLICAS (FRONT-END BOUTIQUE)
|--------------------------------------------------------------------------
*/

// 1. Home (Hero Vídeo + Destaques Energia)
Route::get('/', [PageController::class, 'home'])->name('home');

// 2. Curadoria (Imóveis Públicos)
Route::get('/curadoria', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/curadoria/{property}', [PropertyController::class, 'show'])->name('properties.show');

// Ações no Imóvel (Visita/Contato)
Route::post('/curadoria/{property}/visit', [PropertyController::class, 'sendVisitRequest'])->name('properties.visit');
Route::post('/curadoria/{property}/contact', [PropertyController::class, 'sendContact'])->name('properties.contact');

// 3. Jornal Cielo (Blog) - NOVO
Route::get('/jornal', [BlogController::class, 'index'])->name('blog.index');
Route::get('/jornal/{slug}', [BlogController::class, 'show'])->name('blog.show');

// 4. O Conceito (Sobre Nós)
Route::get('/conceito', [PageController::class, 'about'])->name('pages.about');

// 5. Conversa (Contato)
Route::get('/conversa', [PageController::class, 'contact'])->name('pages.contact');
Route::post('/conversa/enviar', [ToolsController::class, 'sendContact'])->name('contact.send');

// 6. Ferramentas Energéticas (Feng Shui)
Route::get('/ferramentas/feng-shui', [ToolsController::class, 'fengShui'])->name('tools.feng-shui');
Route::post('/ferramentas/feng-shui', [ToolsController::class, 'processFengShui'])->name('tools.feng-shui.process');

// 7. Infraestrutura (Chatbot & Idioma)
Route::post('/chatbot/send', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');
Route::get('language/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'pt', 'fr'])) abort(400);
    session(['locale' => $locale]);
    return redirect()->back()->withCookie(cookie('crow_locale', $locale, 525600));
})->name('language.switch');

// 8. Legal (Mantido)
Route::controller(LegalController::class)->group(function () {
    Route::get('/politica-privacidade', 'privacy')->name('legal.privacy');
    Route::get('/termos-uso', 'terms')->name('legal.terms');
});

// ROTAS ANTIGAS (Mantidas ocultas/comentadas caso precise reativar)
// Route::get('/simulators/capital-gains', [ToolsController::class, 'showGainsSimulator']);
// Route::get('/simulators/imt', [ToolsController::class, 'showImtSimulator']);


/*
|--------------------------------------------------------------------------
| ÁREA RESTRITA (INVESTIDORES & ADMIN) - MANTIDO DO PROJETO ORIGINAL
|--------------------------------------------------------------------------
*/

// Solicitação de Acesso ao Off-Market
Route::post('/access-request', [AccessRequestController::class, 'store'])->name('access-request.store');

Route::middleware(['auth', 'active_access'])->group(function () {
    
    // Rota Exclusiva: Coleção Privée (Off-Market)
    Route::get('/collection-privee', [PropertyController::class, 'offMarket'])->name('properties.off-market');

    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) return redirect()->route('admin.dashboard');
        
        // Mantém a lógica de mostrar imóveis exclusivos no dashboard do cliente
        $exclusiveProperties = collect([]);
        if ($user->role === 'client' || $user->role === 'developer') {
            $exclusiveProperties = App\Models\Property::where('is_exclusive', true)
                                                     ->where('status', 'active')
                                                     ->limit(3)
                                                     ->get(); 
        }
        return view('dashboard', compact('exclusiveProperties'));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- PAINEL DEVELOPER / PARCEIRO ---
    Route::middleware('can:manageProperties,App\Models\User')->group(function () {
        Route::get('/my-properties', [PropertyController::class, 'myProperties'])->name('properties.my');
        Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
        Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
        Route::patch('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
        Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');

        // Gestão de Clientes do Developer
        Route::get('/my-clients', [DeveloperController::class, 'index'])->name('developer.clients');
        Route::post('/my-clients', [DeveloperController::class, 'store'])->name('developer.clients.store');
        Route::patch('/my-clients/{client}/toggle', [DeveloperController::class, 'toggleClientStatus'])->name('developer.clients.toggle');
        Route::patch('/my-clients/{client}/toggle-market', [DeveloperController::class, 'toggleMarketAccess'])->name('developer.clients.toggle-market');
        Route::delete('/my-clients/{client}', [DeveloperController::class, 'destroy'])->name('developer.clients.destroy');
        
        Route::get('/properties/{property}/access-list', [PropertyController::class, 'getAccessList'])->name('properties.access-list');
        Route::post('/properties/{property}/access', [DeveloperController::class, 'toggleAccess'])->name('properties.access');
    });

    // --- PAINEL ADMIN (SISTEMA) ---
    Route::middleware('can:isAdmin,App\Models\User')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        Route::get('/access-requests', [AccessRequestController::class, 'index'])->name('access-requests');
        Route::get('/access-requests/{accessRequest}', [AccessRequestController::class, 'show'])->name('access-requests.show');
        Route::patch('/access-requests/{accessRequest}/approve', [AccessRequestController::class, 'approve'])->name('access-requests.approve');
        Route::patch('/access-requests/{accessRequest}/reject', [AccessRequestController::class, 'reject'])->name('access-requests.reject');
        
        Route::get('/exclusive-requests', [AdminController::class, 'exclusiveRequests'])->name('exclusive-requests');
        Route::patch('/exclusive-requests/{user}/approve', [AdminController::class, 'approveExclusiveRequest'])->name('exclusive-requests.approve');
        Route::delete('/exclusive-requests/{user}/reject', [AdminController::class, 'rejectExclusiveRequest'])->name('exclusive-requests.reject');

        Route::get('/properties/pending', [AdminController::class, 'pendingProperties'])->name('properties.pending');
        Route::patch('/properties/{property}/approve-listing', [PropertyController::class, 'approve'])->name('properties.approve-listing');
        Route::patch('/properties/{property}/reject-listing', [PropertyController::class, 'reject'])->name('properties.reject-listing');

        Route::patch('/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

        Route::get('/properties', [AdminController::class, 'properties'])->name('properties');
        Route::delete('/properties/{property}', [AdminController::class, 'deleteProperty'])->name('properties.destroy');
    });
});

require __DIR__.'/auth.php';