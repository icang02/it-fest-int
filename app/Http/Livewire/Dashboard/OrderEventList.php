<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Event;
use Livewire\Component;
use App\Models\PengelolaEventOrder;
use App\Models\UserEventOrder;

class OrderEventList extends Component
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
        return PengelolaEventOrder::where('user_id', auth()->user()->id)->paginate(10);
    }

    public function confirmOrder($orderId)
    {
        $userOrder = UserEventOrder::find($orderId);
        $userOrder->update([
            'status' => 'selesai',
        ]);
        $pengelolaOrder = PengelolaEventOrder::find($orderId);
        $pengelolaOrder->update([
            'status' => 'selesai',
        ]);

        $place = Event::find($userOrder->event_id);
        $place->update(['ticket_stock' => $place->ticket_stock - $userOrder->quantity]);

        if ($userOrder && $pengelolaOrder) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'success',
                'title' => 'Order dikonfirmasi.',
            ]);
            $this->emit('render');
        }
    }

    public function cancelOrder($orderId)
    {
        $userOrder = UserEventOrder::find($orderId)->update([
            'status' => 'gagal',
        ]);
        $pengelolaOrder = PengelolaEventOrder::find($orderId)->update([
            'status' => 'gagal',
        ]);

        if ($userOrder && $pengelolaOrder) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'error',
                'title' => 'Order dibatalkan!',
            ]);
            $this->emit('render');
        }
    }

    public function confirmDelete($orderId, $jenis)
    {
        $this->jenis = $jenis;

        $this->orderId = $orderId;
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Hapus?',
            'text' => 'Hapus data order?.',
            'id' => $orderId,
        ]);
    }

    public function action()
    {
        $userOrder = UserEventOrder::find($this->orderId)->delete();
        $pengelolaOrder = PengelolaEventOrder::find($this->orderId)->delete();

        if ($userOrder && $pengelolaOrder) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'info',
                'title' => 'Success!',
                'text' => 'Data order dihapus.',
            ]);
            $this->emit('updateCartCount');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.order-event-list', [
            'orderList' => $this->getDataOrder(),
        ])->extends('layouts.dashboard', [
            'title' => 'Event Order'
        ])->section('main-content');
    }
}
