<?php

use App\Http\Livewire\FW;
use App\Http\Livewire\GDL;
use App\Http\Livewire\MEX;
use App\Http\Livewire\NLU;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/FW', FW::class)
        ->name('FW');
    Route::get('/GDL', GDL::class)
        ->name('GDL');
    Route::get('/MEX', MEX::class)
        ->name('MEX');
    Route::get('/NLU', NLU::class)
        ->name('NLU');
    Route::put('/FW/SendEmail', [FW::class, 'sendAction']
    )->name('FW.Send');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});
