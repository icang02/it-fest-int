<?php

namespace App\Http\Livewire\Dashboard\Event;

use App\Models\Event as ModelsEvent;
use Livewire\Component;

class Event extends Component
{
    public function render()
    {
        return view('livewire.dashboard.event.event', [
            'events' => ModelsEvent::paginate(10),
        ])->extends('layouts.dashboard', [
            'title' => 'Event',
        ])->section('main-content');
    }
}
