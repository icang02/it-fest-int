<?php

namespace App\Http\Livewire\Home\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    // protected $listeners = ['render'];

    public function logout()
    {
        $userId = auth()->user()->id;
        Auth::logout();
        User::find($userId)->update(['remember_token' => null]);

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.home.components.navbar');
    }
}
