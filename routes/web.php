<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\IncidentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Public landing can redirect to guest dashboard or login
    return redirect()->route('guest.dashboard');
});

// Guest (read-only)
Route::get('/guest', [GuestController::class, 'index'])->name('guest.dashboard');

// Authenticated routes
Route::middleware(['auth'])->group(function () {

    // Dashboard (auth users)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Incidents - creation (admin + regular)
    Route::get('/incidents/create', [IncidentController::class, 'create'])
        ->name('incidents.create');
    Route::post('/incidents', [IncidentController::class, 'store'])
        ->name('incidents.store');

    // Admin-only routes (status edit & optional delete)
    Route::middleware('role:admin')->group(function () {
        Route::get('/incidents/{id}/edit', [IncidentController::class, 'editStatus'])
            ->name('incidents.editStatus');
        Route::post('/incidents/{id}/update', [IncidentController::class, 'updateStatus'])
            ->name('incidents.updateStatus');

        // Optional: delete incident (enable only if you want delete)
        Route::delete('/incidents/{id}', [IncidentController::class, 'destroy'])
            ->name('incidents.destroy');
    });
});

require __DIR__.'/auth.php';
