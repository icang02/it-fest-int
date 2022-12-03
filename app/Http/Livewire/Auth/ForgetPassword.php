<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgetPassword extends Component
{
    public $email = [];

    public function sendLink()
    {
        $this->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $this->email
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function render()
    {
        return view('livewire.auth.forget-password')
            ->extends('layouts.dashboard',  ['title' => 'Forget Password'])
            ->section('main-content');
    }
}
