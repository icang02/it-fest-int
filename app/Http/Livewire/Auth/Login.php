<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $username;
    public $remember;

    public function rules()
    {
        return [
            'email' => ['required'],
            'password' => ['required'],
        ];
    }

    public function authCheck()
    {
        $this->validate();

        $auth = Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember);

        if ($auth) {
            if (auth()->user()->role_id == 2) {
                request()->session()->regenerate();
                return redirect('/');
            } else {
                request()->session()->regenerate();
                return redirect()->route('dashboard');
            }
        } else {
            session()->flash('error', 'Your email or password is wrong.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->extends('layouts.dashboard', ['title' => 'Login'])
            ->section('main-content');
    }
}
