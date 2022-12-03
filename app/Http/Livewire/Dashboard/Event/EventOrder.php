<?php

namespace App\Http\Livewire\Dashboard\Event;

use App\Models\Event;
use App\Models\PengelolaEventOrder;
use App\Models\UserEventOrder;
use Livewire\Component;

class EventOrder extends Component
{
    public $eventId, $name, $place, $cover,
        $qty, $price, $total;
    public $event;

    protected $listeners = ['action'];

    public function mount()
    {
        $this->eventId = session('eventId');
        $this->event = Event::find($this->eventId);

        $this->name = $this->event->name;
        $this->place = $this->event->place;
        $this->cover = $this->event->cover;
        $this->price = $this->event->price;

        $this->qty = session('qty');
        $this->total = $this->qty * $this->price;
    }

    public function checkoutConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Checkout item?',
            'text' => 'Please check your item before checkout.',
            'id' => '',
        ]);
    }

    public function action()
    {
        $userEventOrder = UserEventOrder::create([
            'no_order' => rand(1, 10000),
            'user_id' => auth()->user()->id,
            'event_id' => $this->event->id,
            'quantity' => $this->qty,
            'total_payment' => $this->total,
            'status' => 'pending',
        ]);
        $pengelolaEventOrder = PengelolaEventOrder::create([
            'no_order' => rand(1, 10000),
            'user_id' => auth()->user()->id,
            'event_id' => $this->event->id,
            'quantity' => $this->qty,
            'total_payment' => $this->total,
            'status' => 'pending',
        ]);

        if ($userEventOrder && $pengelolaEventOrder) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success!',
                'text' => 'Please wait...',
                'showConfirmButton' => false,
            ]);

            return redirect()->route('order.success');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.event.event-order')
            ->extends('layouts.dashboard', [
                'title' => 'Order',
            ])->section('main-content');
    }
}
