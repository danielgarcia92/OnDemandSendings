<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\PasswordValidationRules;

class Register extends Component
{
    use PasswordValidationRules;

    public function render()
    {
        if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'cat') {
            return view('livewire.register');
        } else {
            return view('livewire.redirect');
        }
    }

    public function createAction(Request $request)
    {
        if (Auth::user()->rol == 'admin' || Auth::user()->rol == 'cat') {

            Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'rol' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
            ])->validate();

            User::create([
                'name' => $request['name'],
                'rol' => $request['rol'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            return view('livewire.success-register');
        } else {
            return view('livewire.redirect');
        }
    }
}
