<?php

use App\Livewire\UsersPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

    Route::get('/users', UsersPage::class)->name('users');

    Route::get('/users/{user}', UsersPage::class);

    Route::get('/departments', \App\Livewire\DepartmentsPage::class)->name('departments');
});
