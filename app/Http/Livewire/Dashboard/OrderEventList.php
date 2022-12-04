<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Event;
use Livewire\Component;
use App\Models\PengelolaEventOrder;
use App\Models\UserEventOrder;
use Illuminate\Support\Facades\Storage;

class OrderEventList extends Component
{
    protected $listeners = ['action', 'render'];
    public $orderId;
    public $Jenis;

    public function mount()
    {
        $this->getDataOrder();
        $this->getData();
    }

    public function getDataOrder()
    {
        return PengelolaEventOrder::where('user_id', auth()->user()->id)->paginate(10);
    }
    public function getData()
    {
        return UserEventOrder::where('user_id', auth()->user()->id)->paginate(10);
    }

    public function confirmOrder($orderId)
    {
        $userOrder = UserEventOrder::find($orderId);
        $pengelolaOrder = PengelolaEventOrder::find($orderId);

        $userOrder->update(['status' => 'selesai']);
        $pengelolaOrder->update(['status' => 'selesai']);

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
        $pengelolaOrder = PengelolaEventOrder::find($this->orderId);
        if ($pengelolaOrder->image_tf != null)
            Storage::delete($pengelolaOrder->image_tf);
        $pengelolaOrder->delete();

        if ($pengelolaOrder) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'info',
                'title' => 'Success!',
                'text' => 'Data order dihapus.',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.order-event-list', [
            'orderList' => $this->getDataOrder(),
            'getData' => $this->getData(),
        ])->extends('layouts.dashboard', [
            'title' => 'Event Order'
        ])->section('main-content');
    }
}
