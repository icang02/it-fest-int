<?php

namespace App\Http\Livewire\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class Register extends Component
{
    public $name, $username, $email,
        $password, $password_confirmation,
        $roleId, $agree;
    public $roles;

    public function mount()
    {
        $this->roles = Role::where('id', '!=', 1)->get();
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'username' => ['required', 'min:6', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'roleId' => ['required'],
            'password' => ['required', 'min:6', 'confirmed'],
            'agree' => ['required'],
        ];
    }

    public function registerSend()
    {
        // dd($this->roleId);
        $this->validate();

        $user = User::create([
            'name' => Str::title($this->name),
            'username' => Str::lower($this->username),
            'email' => $this->email,
            'role_id' => $this->roleId,
            'password' => bcrypt($this->password),
        ]);

        Auth::login($user, true);

        return redirect()->route('dashboard')->with('success', 'Congratulation—your account has been active.');
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->extends('layouts.dashboard',  ['title' => 'Register'])
            ->section('main-content');
    }
}
