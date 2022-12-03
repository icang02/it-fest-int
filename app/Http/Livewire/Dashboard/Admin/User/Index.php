<?php

namespace App\Http\Livewire\Dashboard\Admin\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $role;
    protected $listeners = ['action'];
    protected $paginationTheme = 'bootstrap';

    public function mount(Role $role)
    {
        $this->role = $role;
    }

    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Checkout this item?',
            'text' => 'Please check your item before checkout.',
            'id' => $id,
        ]);
    }

    public function action($userId)
    {
        $user = User::find($userId)->delete();
        if ($user) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success!',
                'text' => 'User has been deleted.',
            ]);

            $count = User::where('role_id', $this->role->id)->orderBy('id')->paginate(10)->count();
            if ($count == 0) {
                $this->previousPage();
            }
        }
    }

    public function render()
    {
        return view('livewire.dashboard.admin.user.index', [
            'users' => User::where('role_id', $this->role->id)->orderBy('id')->paginate(10)
        ])->extends('layouts.dashboard', [
            'title' => 'User',
        ])->section('main-content');
    }
}
