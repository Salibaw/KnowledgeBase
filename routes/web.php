<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\KnowledgeBaseController;
use App\Http\Controllers\admin\TicketController;
use App\Http\Controllers\AssignmentController;


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

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/kb', [LandingController::class, 'kb'])->name('kb.public');
Route::get('/kb/{id}', [LandingController::class, 'show'])->name('kb.detail');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    // Manajemen User (CRUD)
    Route::resource('users', UserController::class);
    // Log History
    Route::get('/logs', function () {
        $logs = \App\Models\LogHistory::with('user')->latest()->paginate(20);
        return view('admin.logs.index', compact('logs'));
    })->name('logs.index');
    // Manajemen Tiket
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{id}/assign', [TicketController::class, 'assign'])->name('tickets.assign');
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    // Manajemen Knowledge Base
    Route::get('/knowledge-base', [KnowledgeBaseController::class, 'index'])->name('knowledge-base.index');
    Route::delete('/knowledge-base/{id}', [KnowledgeBaseController::class, 'destroy'])->name('knowledge-base.destroy');
    Route::post('/knowledge-base/verify/{id}', [KnowledgeBaseController::class, 'verify'])->name('kb.verify');
});

Route::middleware(['auth', 'role:teknisi'])->prefix('teknisi')->name('teknisi.')->group(function () {
    // Dashboard Teknisi
    Route::get('/dashboard', [DashboardController::class, 'teknisi'])->name('dashboard');
    // Kelola Tugas (index & solve)
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::post('/assignments/{id}/solve', [AssignmentController::class, 'solve'])->name('assignments.solve');
});
Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route Tiket Pelanggan
    Route::get('/tickets', [TicketController::class, 'pelanggan'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create_pelanggan'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store_pelanggan'])->name('tickets.store');

    Route::post('/tickets/get-recommendation', [TicketController::class, 'getRecommendation'])->name('tickets.recommendation');
});

require __DIR__ . '/auth.php';
