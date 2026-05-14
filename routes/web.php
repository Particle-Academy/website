<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Partners;
use App\Livewire\Admin\Stories;
use App\Livewire\Admin\Waitinglist;
use App\Livewire\Auth\Login;
use App\Livewire\Microsites\Home as MicrositeHome;
use App\Livewire\Pages\Coaches;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Privacy;
use App\Livewire\Pages\Sponsors;
use App\Livewire\Pages\Terms;
use App\Livewire\Pages\Ui;
use Illuminate\Support\Facades\Route;

// Get the host from the app URL for domain routing
$host = parse_url(config('app.url'), PHP_URL_HOST);

// Subdomain routes (Microsites)
Route::domain('{subdomain}.'.$host)->group(function () {
    Route::get('/', MicrositeHome::class)->name('subdomain.home');
});

// Main application routes
Route::domain($host)->group(function () {
    // Public routes
    Route::get('/', Home::class);
    Route::get('/coaches', Coaches::class)->name('coaches');
    Route::get('/partners', App\Livewire\Pages\Partners::class)->name('partners');
    Route::get('/sponsors', Sponsors::class)->name('sponsors');
    Route::get('/privacy', Privacy::class)->name('privacy');
    Route::get('/terms', Terms::class)->name('terms');
    Route::get('/ui', Ui::class)->name('ui');
    Route::get('/login', Login::class)->name('login');

    // Admin routes - protected by auth middleware
    Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
        Route::get('/', Dashboard::class)->name('admin.dashboard');
        Route::get('/waitinglist', Waitinglist::class)->name('admin.waitinglist');
        Route::get('/stories', Stories::class)->name('admin.stories');
        Route::get('/partners', Partners::class)->name('admin.partners');
    });
});
