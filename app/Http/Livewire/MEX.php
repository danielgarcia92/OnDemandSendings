<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MEX extends Component
{
    public function render()
    {
        if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'jt' || Auth::user()->rol == 'ccv' || Auth::user()->rol == 'mex') {
            return view('livewire.m-e-x');
        }

        return view('livewire.redirect');
    }
}
