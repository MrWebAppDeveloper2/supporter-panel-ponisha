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
       Route::get('/{role}/edit', App\Livewire\Role\Edit::class)->name('edit');
       Route::get('/{role}/users', App\Livewire\Role\Users::class)->name('users');
       Route::get('/{role}/add/user', App\Livewire\Role\AddUser::class)->name('add.user');
    });

    // workgroup
    Route::prefix('workgroup/')->name('workgroup.')->group(function (){
        Route::get('/', \App\Livewire\Workgroup\Index::class)->name('index');
//        Route::get('/{workgroup}/permissions', App\Livewire\Role\Permissions::class)->name('permission');
//        Route::get('/create', App\Livewire\Role\Create::class)->name('create');
//        Route::get('/{workgroup}/edit', App\Livewire\Role\Edit::class)->name('edit');
//        Route::get('/{workgroup}/users', App\Livewire\Role\Users::class)->name('users');
//        Route::get('/{workgroup}/add/user', App\Livewire\Role\AddUser::class)->name('add.user');
    });
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
