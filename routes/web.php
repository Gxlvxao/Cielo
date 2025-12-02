<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

// Public property routes (accessible to everyone)
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

// Access Request Routes
Route::post('/access-request', [App\Http\Controllers\AccessRequestController::class, 'store'])->name('access-request.store');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Property management routes (for developers and admins)
    Route::middleware('can:manageProperties,App\Models\User')->group(function () {
        Route::get('/my-properties', [PropertyController::class, 'myProperties'])->name('properties.my');
        Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
        Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
        Route::patch('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
        Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    });

    // Admin routes
    Route::middleware('can:isAdmin,App\Models\User')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/access-requests', [AdminController::class, 'accessRequests'])->name('access-requests');
        Route::patch('/access-requests/{accessRequest}/approve', [AdminController::class, 'approveAccessRequest'])->name('access-requests.approve');
        Route::patch('/access-requests/{accessRequest}/reject', [AdminController::class, 'rejectAccessRequest'])->name('access-requests.reject');
        Route::get('/properties', [AdminController::class, 'properties'])->name('properties');
        Route::delete('/properties/{property}', [AdminController::class, 'deleteProperty'])->name('properties.destroy');
    });
});

require __DIR__.'/auth.php';
