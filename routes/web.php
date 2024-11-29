<?php

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

    Route::get('/users', \App\Livewire\UsersPage::class)->name('users');

//    Route::get('/users/{user}', \App\Livewire\UsersPage::class);

    Route::get('/departments', \App\Livewire\Department\Index::class)->name('departments');

    Route::get('/provinces', \App\Livewire\Province\Index::class)->name('provinces');

    Route::get('/zips', \App\Livewire\ZipsPage::class)->name('zips');

    Route::get('/stores', \App\Livewire\StoresPage::class)->name('stores');

    Route::get('/employees', \App\Livewire\EmployeesPage::class)->name('employees');

    Route::get('/payrolls', \App\Livewire\PayrollsPage::class)->name('payrolls');
});
