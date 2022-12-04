<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Index extends Component
{
    public function mount()
    {
        if (Gate::allows('pengunjung')) return abort(404);
    }

    public function render()
    {
        return view('livewire.dashboard.index')
            ->extends('layouts.dashboard', ['title' => 'Dashboard'])
            ->section('main-content');
    }
}
