<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;

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
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('web')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// Routes pour l'admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', function () {
        // Gestion des utilisateurs
    })->name('admin.users');
});

// Routes pour les clients
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/profile', function () {
        // Profil client
    })->name('client.profile');
});

// Routes pour les agents
Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/tickets', function () {
        // Gestion des tickets
    })->name('agent.tickets');
});

require __DIR__.'/auth.php';
