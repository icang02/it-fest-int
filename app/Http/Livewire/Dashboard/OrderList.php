<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\PengelolaEventOrder;
use App\Models\PengelolaOrder;
use App\Models\TourPlace;
use App\Models\UserEventOrder;
use App\Models\UserOrder;
use Livewire\Component;

class OrderList extends Component
{
    protected $listeners = ['action', 'render'];
    public $orderId;
    public $Jenis;

    public function mount()
    {
        $this->getDataOrder();
    }

    public function getDataOrder()
    {
        if (auth()->user()->role_id == 2) {
            return UserOrder::where('user_id', auth()->user()->id)->paginate(10);
        } elseif (auth()->user()->role_id == 3) {
            return PengelolaOrder::where('tour_place_id', auth()->user()->id)->paginate(10);
        }
    }

    public function getDataEventOrder()
    {
        if (auth()->user()->role_id == 2) {
            return UserEventOrder::where('user_id', auth()->user()->id)->paginate(10);
        } elseif (auth()->user()->role_id == 3) {
            return PengelolaEventOrder::where('event_id', auth()->user()->id)->paginate(10);
        }
    }

    public function confirmOrder($orderId)
    {
        $userOrder = UserOrder::find($orderId);
        $userOrder->update([
            'status' => 'selesai',
        ]);
        $pengelolaOrder = PengelolaOrder::find($orderId);
        $pengelolaOrder->update([
            'status' => 'selesai',
        ]);

        $place = TourPlace::find($userOrder->tour_place_id);
        $place->update(['ticket_stock' => $place->ticket_stock - $userOrder->quantity]);

        if ($userOrder && $pengelolaOrder) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'success',
                'title' => 'Order confirmed!',
            ]);
            $this->emit('render');
            $this->emit('updateCartCount');
        }
    }

    public function cancelOrder($orderId)
    {
        $userOrder = UserOrder::find($orderId)->update([
            'status' => 'gagal',
        ]);
        $pengelolaOrder = PengelolaOrder::find($orderId)->update([
            'status' => 'gagal',
        ]);

        if ($userOrder && $pengelolaOrder) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'error',
                'title' => 'Order canceled!',
            ]);
            $this->emit('render');
            $this->emit('updateCartCount');
        }
    }

    public function confirmDelete($orderId, $jenis)
    {
        $this->jenis = $jenis;

        $this->orderId = $orderId;
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Cancel?',
            'text' => 'Your order will be cancelled.',
            'id' => $orderId,
        ]);
    }

    public function action()
    {
        if ($this->jenis == 'wisata') {
            $userOrder = UserOrder::find($this->orderId)->delete();
            $pengelolaOrder = PengelolaOrder::find($this->orderId)->delete();
        } else {
            $userOrder = UserEventOrder::find($this->orderId)->delete();
            $pengelolaOrder = PengelolaEventOrder::find($this->orderId)->delete();
        }

        if ($userOrder && $pengelolaOrder) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'info',
                'title' => 'Success!',
                'text' => 'Your order has been cancelled.',
            ]);
            $this->emit('updateCartCount');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.order-list', [
            'orderList' => $this->getDataOrder(),
            'orderEventList' => $this->getDataEventOrder(),
        ])->extends('layouts.dashboard', [
            'title' => 'Order'
        ])->section('main-content');
    }
}
