<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    // role
    Route::prefix('role/')->name('role.')->group(function (){
       Route::get('/', App\Livewire\Role\Index::class)->name('index');
       Route::get('/{role}/permissions', App\Livewire\Role\Permissions::class)->name('permission');
       Route::get('/create', App\Livewire\Role\Create::class)->name('create');
    });
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
