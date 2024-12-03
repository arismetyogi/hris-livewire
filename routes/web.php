<?php

use App\Http\Controllers\UserController;
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

    Route::get('/users', \App\Livewire\User\Index::class)->name('users');
    Route::get('/users-export', UserController::class . '@export')->name('user.export');

    Route::get('/departments', \App\Livewire\Department\Index::class)->name('departments');

    Route::get('/provinces', \App\Livewire\Province\Index::class)->name('provinces');

    Route::get('/zips', \App\Livewire\Zip\Index::class)->name('zips');

    Route::get('/stores', \App\Livewire\Store\Index::class)->name('stores');

    Route::get('/employees', \App\Livewire\Employee\Index::class)->name('employees');

    Route::get('/payrolls', \App\Livewire\Payroll\Index::class)->name('payrolls');
});
