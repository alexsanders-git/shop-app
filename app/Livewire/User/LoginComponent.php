<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public string $email;
    public string $password;

    public function login()
    {
        $validated = $this->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($validated)) {
            session()->flash('success', 'Login successfully!');

            $this->redirectRoute('account', navigate: true);
        } else {
            $this->reset();
            $this->js("toastr.error('Login failed!')");
        }
    }

    public function render()
    {
        return view('livewire.user.login-component');
    }
}
