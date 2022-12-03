<?php

namespace App\Http\Livewire\Home\Event;

use App\Models\Event;
use App\Models\PengelolaEventOrder;
use App\Models\User;
use App\Models\UserEventOrder;
use Livewire\Component;

class OrderPage extends Component
{
    public $eventId, $name, $place, $cover,
        $qty, $price, $total, $description, $noRek;
    public $event;

    protected $listeners = ['action'];

    public function mount()
    {
        $this->eventId = session('eventId');
        $this->event = Event::find($this->eventId);
        $noRek = $this->event->user->no_rek;

        $this->name = $this->event->name;
        $this->place = $this->event->place;
        $this->cover = $this->event->cover;
        $this->price = $this->event->price;
        $this->description = $this->event->description;
        $this->noRek = $noRek;

        $this->qty = session('qty');
        $this->total = $this->qty * $this->price;
    }

    public function checkoutConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Checkout item?',
            'text' => 'Silahkan cek pesanan sebelum checkout.',
            'id' => '',
        ]);
    }

    public function action()
    {
        $no_order = rand(1, 10000);

        $userOrder = UserEventOrder::create([
            'no_order' => $no_order,
            'user_id' => auth()->user()->id,
            'event_id' => $this->event->id,
            'quantity' => $this->qty,
            'total_payment' => $this->total,
            'status' => 'pending',
        ]);
        $pengelolaOrder = PengelolaEventOrder::create([
            'no_order' => $no_order,
            'user_id' => auth()->user()->id,
            'event_id' => $this->event->id,
            'quantity' => $this->qty,
            'total_payment' => $this->total,
            'status' => 'pending',
        ]);
        if ($userOrder && $pengelolaOrder) {
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
        return view('livewire.home.event.order-page')
            ->extends('layouts.home', ['title' => 'Order Event'])
            ->section('main-content');
    }
}
