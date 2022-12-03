<?php

namespace App\Http\Livewire\Home\Wisata;

use App\Models\TourPlace;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function render()
    {
        return view('livewire.home.wisata.index', [
            'allWisata' => TourPlace::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('city', 'like', '%' . $this->search . '%')
                ->orWhere('address', 'like', '%' . $this->search . '%')
                ->paginate(8),
        ])
            ->extends('layouts.home', ['title' => 'Wisata'])
            ->section('main-content');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function limitData($limit)
    {
        dd($limit);
    }
}
