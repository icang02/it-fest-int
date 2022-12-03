<?php

namespace App\Http\Livewire\Dashboard\Event;

use App\Models\Event;
use Livewire\Component;

class PengelolaDetail extends Component
{
    public $eventId;

    public function mount($eventId)
    {
        $this->eventId = $eventId;
    }

    public function render()
    {
        return view('livewire.dashboard.event.pengelola-detail', [
            'event' => Event::find($this->eventId),
        ])
            ->extends('layouts.dashboard', [
                'title' => 'Detail Event',
            ])->section('main-content');
    }
}
