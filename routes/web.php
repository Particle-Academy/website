<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Waitinglist;
use App\Livewire\Admin\Stories;
use App\Livewire\Admin\Partners;
use App\Livewire\Auth\Login;

// Public routes
Route::get('/', Home::class);
Route::get('/coaches', App\Livewire\Pages\Coaches::class)->name('coaches');
Route::get('/partners', App\Livewire\Pages\Partners::class)->name('partners');
Route::get('/login', Login::class)->name('login');

// Admin routes - protected by auth middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', Dashboard::class)->name('admin.dashboard');
    Route::get('/waitinglist', Waitinglist::class)->name('admin.waitinglist');
    Route::get('/stories', Stories::class)->name('admin.stories');
    Route::get('/partners', Partners::class)->name('admin.partners');
});
