<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Api\ChatbotController;
use App\Http\Controllers\AccessRequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CIELO - ROTAS PÚBLICAS (FRONT-END BOUTIQUE)
|--------------------------------------------------------------------------
*/

// 1. Home
Route::get('/', [PageController::class, 'home'])->name('home');

// 2. O Conceito (Sobre Nós)
Route::get('/conceito', [PageController::class, 'about'])->name('pages.about');

// 3. Curadoria (Imóveis)
Route::get('/curadoria', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/curadoria/{property}', [PropertyController::class, 'show'])->name('properties.show');

// Ações no Imóvel
Route::post('/curadoria/{property}/visit', [PropertyController::class, 'sendVisitRequest'])->name('properties.visit');
Route::post('/curadoria/{property}/contact', [PropertyController::class, 'sendContact'])->name('properties.contact');

// 4. Jornal Cielo (Blog)
Route::get('/journal', [BlogController::class, 'index'])->name('blog.index');
Route::get('/journal/{post}', [BlogController::class, 'show'])->name('blog.show');

// 5. Conversa (Contato)
Route::get('/conversa', [PageController::class, 'contact'])->name('pages.contact');
Route::post('/conversa/enviar', [ToolsController::class, 'sendContact'])->name('contact.send');

// 6. Solicitar Acesso (NOVO - Formulário Público)
Route::get('/solicitar-acesso', [AccessRequestController::class, 'create'])->name('access-request.create');
Route::post('/access-request', [AccessRequestController::class, 'store'])->name('access-request.store');

// 7. FERRAMENTAS (TOOLS)
Route::prefix('ferramentas')->name('tools.')->group(function () {
    // Vistas (GET)
    Route::get('/mais-valias', [ToolsController::class, 'showGainsSimulator'])->name('gains');
    Route::get('/credito', [ToolsController::class, 'showCreditSimulator'])->name('credit');
    Route::get('/imt', [ToolsController::class, 'showImtSimulator'])->name('imt');
    
    // FENG SHUI (GET + POST)
    Route::match(['get', 'post'], '/feng-shui', [ToolsController::class, 'fengShui'])->name('feng-shui');

    // Ações (POST - AJAX)
    Route::post('/mais-valias/calcular', [ToolsController::class, 'calculateGains'])->name('gains.calculate');
    Route::post('/credito/enviar', [ToolsController::class, 'sendCreditLead'])->name('credit.send');
    Route::post('/imt/enviar', [ToolsController::class, 'sendImtLead'])->name('imt.send');
});

// 8. Infraestrutura
Route::post('/chatbot/send', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');

Route::get('language/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'pt', 'fr'])) abort(400);
    session(['locale' => $locale]);
    return redirect()->back()->withCookie(cookie('crow_locale', $locale, 525600));
})->name('language.switch');

// 9. Legal
Route::controller(LegalController::class)->group(function () {
    Route::get('/politica-privacidade', 'privacy')->name('legal.privacy');
    Route::get('/termos-uso', 'terms')->name('legal.terms');
    Route::get('/politica-cookies', 'cookies')->name('legal.cookies');
    Route::get('/aviso-legal', 'notice')->name('legal.notice');
});

/*
|--------------------------------------------------------------------------
| ÁREA RESTRITA (INVESTIDORES & ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'active_access'])->group(function () {
    
    // Off-Market
    Route::get('/collection-privee', [PropertyController::class, 'offMarket'])->name('properties.off-market');

    // Dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) return redirect()->route('admin.dashboard');
        
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

    // --- PAINEL DEVELOPER ---
    Route::middleware('can:manageProperties,App\Models\User')->group(function () {
        Route::get('/my-properties', [PropertyController::class, 'myProperties'])->name('properties.my');
        Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
        Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
        Route::patch('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
        Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');

        Route::get('/my-clients', [DeveloperController::class, 'index'])->name('developer.clients');
        Route::post('/my-clients', [DeveloperController::class, 'store'])->name('developer.clients.store');
        Route::patch('/my-clients/{client}/toggle', [DeveloperController::class, 'toggleClientStatus'])->name('developer.clients.toggle');
        Route::patch('/my-clients/{client}/toggle-market', [DeveloperController::class, 'toggleMarketAccess'])->name('developer.clients.toggle-market');
        Route::delete('/my-clients/{client}', [DeveloperController::class, 'destroy'])->name('developer.clients.destroy');
        
        Route::get('/properties/{property}/access-list', [PropertyController::class, 'getAccessList'])->name('properties.access-list');
        Route::post('/properties/{property}/access', [DeveloperController::class, 'toggleAccess'])->name('properties.access');
    });

    // --- PAINEL ADMIN ---
    Route::middleware('can:isAdmin,App\Models\User')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        Route::get('/access-requests', [AccessRequestController::class, 'index'])->name('access-requests');
        Route::get('/access-requests/{accessRequest}', [AccessRequestController::class, 'show'])->name('access-requests.show');
        Route::patch('/access-requests/{accessRequest}/approve', [AccessRequestController::class, 'approve'])->name('access-requests.approve');
        Route::patch('/access-requests/{accessRequest}/reject', [AccessRequestController::class, 'reject'])->name('access-requests.reject');
        
        Route::get('/exclusive-requests', [AdminController::class, 'exclusiveRequests'])->name('exclusive-requests');
        Route::patch('/exclusive-requests/{user}/approve', [AdminController::class, 'approveExclusiveRequest'])->name('exclusive-requests.approve');
        Route::delete('/exclusive-requests/{user}/reject', [AdminController::class, 'rejectExclusiveRequest'])->name('exclusive-requests.reject');

        // CRUD de Posts do Admin
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);

        Route::get('/properties/pending', [AdminController::class, 'pendingProperties'])->name('properties.pending');
        Route::patch('/properties/{property}/approve-listing', [PropertyController::class, 'approve'])->name('properties.approve-listing');
        Route::patch('/properties/{property}/reject-listing', [PropertyController::class, 'reject'])->name('properties.reject-listing');
        
        // Ação de Toggle Energia da Semana
        Route::patch('/properties/{property}/toggle-energy', [AdminController::class, 'toggleEnergy'])->name('properties.toggle-energy');

        Route::patch('/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

        Route::get('/properties', [AdminController::class, 'properties'])->name('properties');
        Route::delete('/properties/{property}', [AdminController::class, 'deleteProperty'])->name('properties.destroy');
    });
});

require __DIR__.'/auth.php';