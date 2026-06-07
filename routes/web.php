<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\StoryController as AdminStoryController;
use App\Http\Controllers\Admin\WaitingListController as AdminWaitingListController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\WaitingListController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Get the host from the app URL for domain routing
$host = parse_url(config('app.url'), PHP_URL_HOST);

// Subdomain routes (Microsites)
Route::domain('{subdomain}.'.$host)->group(function () {
    Route::get('/', function (string $subdomain) {
        $map = [
            'tribe-trip' => 'Microsites/TribeTrip',
            'laravel-fun-labs' => 'Microsites/LaravelFunLabs',
            'laravel-catalog' => 'Microsites/LaravelCatalog',
        ];

        if (! isset($map[$subdomain])) {
            abort(404);
        }

        return Inertia::render($map[$subdomain]);
    })->name('subdomain.home');
});

// Main application routes
Route::domain($host)->group(function () {
    // Public routes
    Route::get('/', fn () => Inertia::render('Home'));
    Route::get('/coaches', fn () => Inertia::render('Coaches'))->name('coaches');
    Route::get('/partners', fn () => Inertia::render('Partners'))->name('partners');
    Route::get('/sponsors', fn () => Inertia::render('Sponsors'))->name('sponsors');
    Route::get('/privacy', fn () => Inertia::render('Privacy'))->name('privacy');
    Route::get('/terms', fn () => Inertia::render('Terms'))->name('terms');

    Route::post('/waiting-list', [WaitingListController::class, 'store'])->name('waiting-list.store');

    Route::get('/login', fn () => Inertia::render('Auth/Login'))->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // TEMP — Inertia plumbing verification. Delete once /privacy or another
    // page has been migrated and verified.
    Route::get('/_inertia-test', fn () => Inertia::render('Test'));

    // Admin routes - protected by auth middleware
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/waitinglist', [AdminWaitingListController::class, 'index'])->name('waitinglist');
        Route::put('/waitinglist/{waitingList}', [AdminWaitingListController::class, 'update'])->name('waitinglist.update');
        Route::delete('/waitinglist/{waitingList}', [AdminWaitingListController::class, 'destroy'])->name('waitinglist.destroy');

        Route::get('/stories', [AdminStoryController::class, 'index'])->name('stories');
        Route::post('/stories', [AdminStoryController::class, 'store'])->name('stories.store');
        Route::put('/stories/{story}', [AdminStoryController::class, 'update'])->name('stories.update');
        Route::delete('/stories/{story}', [AdminStoryController::class, 'destroy'])->name('stories.destroy');

        Route::get('/partners', [AdminPartnerController::class, 'index'])->name('partners');
        Route::post('/partners', [AdminPartnerController::class, 'store'])->name('partners.store');
        Route::put('/partners/{partner}', [AdminPartnerController::class, 'update'])->name('partners.update');
        Route::delete('/partners/{partner}', [AdminPartnerController::class, 'destroy'])->name('partners.destroy');
    });
});
