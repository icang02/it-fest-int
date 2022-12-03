<?php

namespace App\Http\Livewire\Dashboard\Event;

use App\Models\PengelolaEventOrder;
use App\Models\UserEventOrder;
use Livewire\Component;
use Livewire\WithFileUploads;

class EventOrderDetail extends Component
{
    use WithFileUploads;

    protected $listeners = [
        'action', 'render',
        'orderSuccess' => 'orderSuccessHandler'
    ];
    public $order, $image;

    public function mount($orderId)
    {
        $this->order = UserEventOrder::find($orderId);

        if ($this->order->status == 'pending') {
            $order = $this->order;
        }
    }

    public function orderSuccessHandler()
    {
        $userOrder = UserEventOrder::find($this->order->id)->update(['status' => 'selesai']);
        $pengelolaOrder = PengelolaEventOrder::find($this->order->id)->update(['status' => 'selesai']);
        if ($userOrder && $pengelolaOrder) {
            Event::find($this->order->tour_place_id)->update([
                'ticket_stock' => $this->order->event->ticket_stock - $this->order->quantity,
            ]);

            redirect()->route('orderList');
        }
    }

    public function action()
    {
        return redirect()->route('orderList');
    }

    public function uploadImage()
    {
        $this->validate([
            'image' => 'image|max:4096',
        ]);

        $imgUser2 = $this->image->store('img/bukti-tf/pengunjung');
        $imgUser3 = $this->image->store('img/bukti-tf/pengelola');

        UserEventOrder::find($this->order->id)->update([
            'image_tf' => $imgUser2,
        ]);
        PengelolaEventOrder::find($this->order->id)->update([
            'image_tf' => $imgUser3,
        ]);

        if ($imgUser2 && $imgUser3) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success!',
                'text' => 'Upload image successfully.',
            ]);
            $this->emit('render');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.event.event-order-detail')
            ->extends('layouts.dashboard', [
                'title' => 'Order',
            ])->section('main-content');
    }
}
