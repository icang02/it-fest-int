<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class MyProfile extends Component
{
    use WithFileUploads;
    public $userId, $name, $email, $username, $userType, $imgProfil, $noRek;
    public $imgAvatars;
    public $usernameDelete, $checkboxDeactive;
    public $user;

    protected $listeners = ['action'];

    public function mount()
    {
        $this->user = User::find(auth()->user()->id);

        $this->userId = $this->user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->username = $this->user->username;
        $this->userType = $this->user->role->name;
        $this->imgAvatars = $this->user->image_profil;
        $this->noRek = $this->user->no_rek;

        // dd($this->imgAvatars);
    }

    public function updateUser($userId)
    {
        // dd($this->imgAvatars);
        $rules = [
            'name' => 'required',
            'email' => 'required|email:dns',
        ];
        if ($this->imgAvatars != null) {
            $rules['imgProfil'] = 'image|max:2048';
        }

        $this->validate($rules);

        if ($this->imgProfil != null) {
            if ($this->imgAvatars != null) {
                Storage::delete($this->imgAvatars);
            }
            $avatars = $this->imgProfil->store('img/avatars');
        }

        $user = User::find($userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'image_profil' => $avatars ?? null,
        ]);

        if ($user) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'success',
                'title' => 'Profile updated!',
            ]);
            $this->emit('render');
        }
    }

    public function resetForm()
    {
        $user = User::find(auth()->user()->id);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->noRek = $user->no_rek;
    }

    public function dactiveAccount($userId)
    {
        $this->validate([
            'usernameDelete' => 'in:' . auth()->user()->username,
            'checkboxDeactive' => 'required',
        ]);

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Are you sure?',
            'text' => 'Account cannot be returned.',
            'id' => $userId,
        ]);
    }

    public function action($userId)
    {
        $user = User::find($userId);
        if ($user->image_profil != null)
            Storage::delete($user->image_profil);
        $user->delete();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.home.my-profile')
            ->extends('layouts.home', [
                'title' => 'Profile',
            ])->section('main-content');
    }
}
