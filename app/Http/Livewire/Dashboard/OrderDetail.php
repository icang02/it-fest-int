<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\PengelolaOrder;
use App\Models\TourPlace;
use App\Models\UserOrder;
use Livewire\Component;
use Livewire\WithFileUploads;

class OrderDetail extends Component
{
    use WithFileUploads;

    protected $listeners = [
        'action', 'render',
        'orderSuccess' => 'orderSuccessHandler'
    ];
    public $order, $image;
    public $orderId;

    public $snapToken;

    public function mount($orderId)
    {
        $this->order = UserOrder::find($orderId);

        if ($this->order->status == 'pending') {
            $order = $this->order;
        }
    }

    public function orderSuccessHandler()
    {
        $userOrder = UserOrder::find($this->order->id)->update(['status' => 'selesai']);
        $pengelolaOrder = PengelolaOrder::find($this->order->id)->update(['status' => 'selesai']);
        if ($userOrder && $pengelolaOrder) {
            TourPlace::find($this->order->tour_place_id)->update([
                'ticket_stock' => $this->order->tour_place->ticket_stock - $this->order->quantity,
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

        UserOrder::find($this->order->id)->update([
            'image_tf' => $imgUser2,
        ]);
        PengelolaOrder::find($this->order->id)->update([
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
        return view('livewire.dashboard.order-detail')
            ->extends('layouts.dashboard', ['title' => 'Detail'])
            ->section('main-content');
    }
}
