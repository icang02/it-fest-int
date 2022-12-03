<?php

namespace App\Http\Livewire\Dashboard\Event;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class PengelolaIndex extends Component
{
    use WithPagination;
    protected $listeners = ['action'];
    public $eventId;
    public $search = "";

    public function confirmDelete($eventId)
    {
        $this->eventId = $eventId;
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Hapus?',
            'text' => 'Data yang dihapus tidak dapat dikembalikan.',
            'id' => $eventId,
        ]);
    }

    public function action()
    {
        $cover = Event::find($this->eventId)->cover;
        $event = Event::find($this->eventId)->delete();

        if ($cover != null)
            Storage::delete($cover);

        if ($event) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'error',
                'title' => 'Data event dihapus!',
            ]);
            $this->emit('render');
            // $this->emit('updateCartCount');
        }
    }
    public function render()
    {
        return view('livewire.dashboard.event.pengelola-index', [
            'events' => Event::where('user_id', auth()->user()->id)->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('user_id', auth()->user()->id)->where('place', 'like', '%' . $this->search . '%')->paginate(10),
        ])->extends('layouts.dashboard', [
            'title' => 'Event',
        ])->section('main-content');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
