<?php

use App\Http\Livewire\FW;
use App\Http\Livewire\FWACMI;
use App\Http\Livewire\ASA;
use App\Http\Livewire\GDL;
use App\Http\Livewire\MEX;
use App\Http\Livewire\NLU;
use App\Http\Livewire\Register;
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
    Route::get('/FWACMI', FWACMI::class)
        ->name('FWACMI');
    Route::get('/ASA', ASA::class)
        ->name('ASA');
    Route::get('/GDL', GDL::class)
        ->name('GDL');
    Route::get('/MEX', MEX::class)
        ->name('MEX');
    Route::get('/NLU', NLU::class)
        ->name('NLU');

    Route::put('/FW/SendEmail', [FW::class, 'sendAction']
    )->name('FW.Send');
    Route::put('/FWACMI/SendEmail', [FWACMI::class, 'sendAction']
    )->name('FWACMI.Send');
    Route::put('/ASA/SendEmail', [ASA::class, 'sendAction']
    )->name('ASA.Send');
    Route::put('/GDL/SendEmail', [GDL::class, 'sendAction']
    )->name('GDL.Send');
    Route::put('/MEX/SendEmail', [MEX::class, 'sendAction']
    )->name('MEX.Send');
    Route::put('/NLU/SendEmail', [NLU::class, 'sendAction']
    )->name('NLU.Send');

    Route::get('/register', Register::class)
        ->name('register');
    Route::put('/register/CreateUser', [Register::class, 'createAction']
    )->name('register.create');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});
