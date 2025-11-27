<?php
// routes/web.php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\AnimalController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\AgendamentoController;
use App\Http\Controllers\Admin\VendaController;
use App\Http\Controllers\Admin\ServicoController;
use Illuminate\Support\Facades\Route;

// Rota principal - redireciona para dashboard do admin (se autenticado) ou welcome
Route::get('/', function () {
    return auth()->check() 
        ? redirect()->route('admin.dashboard') 
        : view('home');
})->name('home');

// Rotas de autenticação padrão do Laravel (já existem em auth.php)
require __DIR__.'/auth.php';

// Rotas do perfil (mantidas do Laravel)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas administrativas do PetShop
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard do admin (substitui a dashboard padrão)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // CRUDs do sistema
    Route::resource('clientes', ClienteController::class);
    Route::resource('animais', AnimalController::class)->parameters(['animais' => 'animal']);
    Route::resource('produtos', ProdutoController::class);
    Route::resource('agendamentos', AgendamentoController::class);
    Route::resource('vendas', VendaController::class);
    Route::resource('servicos', ServicoController::class);
});

// Redirecionar a rota /dashboard padrão para o admin
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified']);

// Redirecionar /home para admin dashboard (caso exista)
Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
});