<?php

namespace App\Http\Livewire\Home\Event;

use App\Models\Event;
use Livewire\Component;

class Detail extends Component
{
    public $event, $qty, $paymentTotal;

    public function mount($eventId)
    {
        $this->event = Event::find($eventId);
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
                'title' => 'Minimal pesan 1 tiket!',
            ]);
        } else if ($this->qty > $this->event->ticket_stock) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'error',
                'title' => 'Stok tiket tidak cukup!',
            ]);
        }
        // Validasi data
        $this->validate();

        session()->put('eventId', $eventId);
        session()->put('qty', $this->qty);

        return redirect("semua-event/order/$eventId");
    }

    public function render()
    {
        return view('livewire.home.event.detail')
            ->extends('layouts.home', ['title' => 'Detail Wisata'])
            ->section('main-content');
    }
}
