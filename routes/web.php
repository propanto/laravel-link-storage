<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/dashboard', function() {
        return Inertia::render('Dashboard/Index');
    })->name('dashboard.index');

    Route::get('/links', [LinksController::class, 'index'])
        ->name('links.index');

    Route::get('/links/create', [LinksController::class, 'create'])
        ->name('links.create');

    Route::post('/links', [LinksController::class, 'store'])
        ->name('links.store');
        
    Route::get('/links/{link}/edit', [LinksController::class, 'edit'])
        ->name('links.edit');
        
    Route::put('/links/{link}', [LinksController::class, 'update'])
        ->name('links.update');

    Route::delete('/links/{link}', [LinksController::class, 'destroy'])
        ->name('links.destroy');
});

Route::get('/test', function () {
    $response = Http::get("127.0.0.1:8000/api/weather?location=Athens");

    return $response->json();
});