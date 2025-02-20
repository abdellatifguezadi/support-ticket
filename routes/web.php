<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;

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
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/users', function () {
        // Gestion des utilisateurs
    })->name('admin.users');
});

// Routes pour les clients
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/profile', function () {
        // Profil client
    })->name('client.profile');
    Route::get('/client/tickets', [ClientController::class, 'index'])->name('client.tickets');
    Route::post('/client/tickets', [ClientController::class, 'createTicket'])->name('client.tickets.store');
    Route::put('/client/tickets/{id}', [ClientController::class, 'updateTicket'])->name('client.tickets.update');
    Route::delete('/client/tickets/{id}', [ClientController::class, 'destroyTicket'])->name('client.tickets.destroy');
});

// Routes pour les agents
Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/tickets', function () {
        // Gestion des tickets
    })->name('agent.tickets');
});

require __DIR__.'/auth.php';
