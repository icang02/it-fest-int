<?php

namespace App\Http\Livewire\Dashboard\Event;

use App\Models\Event;
use Livewire\Component;

class EventDetail extends Component
{
    public $event, $qty;
    public $paymentTotal;

    public function mount($id)
    {
        $this->event = Event::find($id);
        // dd($id);
    }

    public function rules()
    {
        return [
            'qty' => 'required|numeric|max:' . $this->event->ticket_stock,
        ];
    }

    public function submitToOrder($eventId)
    {
        if ($this->qty == null) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'error',
                'title' => 'Your input field is empty!',
            ]);
        } else if ($this->qty > $this->event->ticket_stock) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'error',
                'title' => 'Not enough stock!',
            ]);
        }
        $this->validate();

        // dd($this->qty);

        session()->put('eventId', $eventId);
        session()->put('qty', $this->qty);

        return redirect("event/order/$eventId");
    }

    public function render()
    {
        return view('livewire.dashboard.event.event-detail', [
            'event' => $this->event,
        ])->extends('layouts.dashboard', [
            'title' => 'Detail Event',
        ])->section('main-content');
    }
}
