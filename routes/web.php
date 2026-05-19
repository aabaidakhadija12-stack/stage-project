<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
     ->name('logout')
     ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard — accessible to all authenticated users
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |----------------------------------------------------------------------
    | Produits — admin & technicien can manage; client can view
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin,technicien')->group(function () {
        Route::resource('produits', ProduitController::class);
        Route::post('produits/{produit}/stock', [ProduitController::class, 'updateStock'])
             ->name('produits.updateStock');
    });

    /*
    |----------------------------------------------------------------------
    | Commandes — admin & client can manage
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin,client')->group(function () {
        Route::resource('commandes', CommandeController::class);
        Route::get('commandes/{commande}/total', [CommandeController::class, 'calculerTotal'])
             ->name('commandes.total');
    });

    /*
    |----------------------------------------------------------------------
    | Clients — admin only
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::resource('clients', ClientController::class);
    });

    /*
    |----------------------------------------------------------------------
    | Fournisseurs — admin only
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::resource('fournisseurs', FournisseurController::class);
    });

    /*
    |----------------------------------------------------------------------
    | Factures — admin only
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::get('factures', [FactureController::class, 'index'])->name('factures.index');
        Route::post('factures', [FactureController::class, 'store'])->name('factures.store');
        Route::get('factures/{facture}', [FactureController::class, 'show'])->name('factures.show');
        Route::delete('factures/{facture}', [FactureController::class, 'destroy'])->name('factures.destroy');
        Route::get('factures/{facture}/pdf', [FactureController::class, 'generatePdf'])->name('factures.pdf');
    });

    /*
    |----------------------------------------------------------------------
    | Maintenances — admin & technicien
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin,technicien')->group(function () {
        Route::resource('maintenances', MaintenanceController::class);
    });
});
