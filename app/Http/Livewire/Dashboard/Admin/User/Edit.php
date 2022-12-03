<?php

namespace App\Http\Livewire\Dashboard\Admin\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $roles;
    public $role, $user;
    public $name, $email, $roleId;

    public function mount(Role $role, User $user)
    {
        $this->roles = Role::all();

        $this->role = $role;
        $this->user = $user;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->roleId = $user->role_id;
    }

    public function UpdateUser($userId)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'roleId' => 'required',
        ];

        $user = User::find($userId);
        if ($this->email === $user->email) {
            $rules['email'] = 'required|email:dns';
        }
        $this->validate($rules);

        $user->update([
            'name' => str()->title($this->name),
            'email' => $this->email,
            'role_id' => intval($this->roleId),
        ]);

        if (intval($this->roleId) == 1) {
            $toPage = 'admin';
        } else if (intval($this->roleId) == 2) {
            $toPage = 'pengunjung';
        } else if (intval($this->roleId) == 3) {
            $toPage = 'pengelola';
        }

        if ($user) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'success',
                'title' => 'Your changes this profile!',
            ]);
        }

        // return redirect()->to("$toPage/$user->username/edit");
    }

    public function formReset($userId)
    {
        $user = User::find($userId);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->roleId = $user->role_id;
    }

    public function render()
    {
        return view('livewire.dashboard.admin.user.edit', [
            'user' => $this->user,
        ])->extends('layouts.dashboard', [
            'title' => 'User Edit',
        ])->section('main-content');
    }
}
