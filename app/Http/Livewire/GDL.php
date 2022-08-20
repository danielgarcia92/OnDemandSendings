<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class GDL extends Component
{
    public function render()
    {
        if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'jt' || Auth::user()->rol == 'ccv' || Auth::user()->rol == 'gdl') {
            return view('livewire.g-d-l');
        }

        return view('livewire.redirect');
    }
}
