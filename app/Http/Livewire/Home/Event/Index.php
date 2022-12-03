<?php

namespace App\Http\Livewire\Home\Event;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function render()
    {
        return view('livewire.home.event.index', [
            'allEvent' => Event::where('name', 'like', '%' . $this->search . '%')->paginate(8),
        ])
            ->extends('layouts.home', ['title' => 'Event'])
            ->section('main-content');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
