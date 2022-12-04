<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\TourPlace;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Wisata extends Component
{
    use WithPagination;
    public $allWisata;
    public $wisata;

    public function mount()
    {
        $role_id = auth()->user()->role_id;
        if (Gate::allows('pengunjung')) {
            return abort(404);
        } elseif ($role_id == 3) {
            $this->wisata = TourPlace::find(auth()->user()->id);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.wisata')
            ->extends('layouts.dashboard', ['title' => 'Wisata'])
            ->section('main-content');
    }
}
