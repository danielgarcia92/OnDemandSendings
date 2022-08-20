<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NLU extends Component
{
    public function render()
    {
        if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'jt' || Auth::user()->rol == 'ccv' || Auth::user()->rol == 'nlu') {
            return view('livewire.n-l-u');
        }

        return view('livewire.redirect');
    }
}
