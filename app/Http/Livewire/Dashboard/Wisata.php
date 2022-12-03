<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\TourPlace;
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
        if ($role_id == 2) {
            $this->allWisata = TourPlace::all();
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
