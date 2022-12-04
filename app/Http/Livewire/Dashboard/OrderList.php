<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\PengelolaOrder;
use App\Models\TourPlace;
use App\Models\UserOrder;
use Illuminate\Support\Facades\Storage;
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
        return PengelolaOrder::where('user_id', auth()->user()->id)->paginate(10);
    }

    public function confirmOrder($orderId)
    {
        $userOrder = UserOrder::find($orderId);
        $pengelolaOrder = PengelolaOrder::find($orderId);

        $userOrder->update(['status' => 'selesai']);
        $pengelolaOrder->update(['status' => 'selesai']);

        $place = TourPlace::find($userOrder->tour_place_id);
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
        $userOrder = UserOrder::find($orderId)->update([
            'status' => 'gagal',
        ]);
        $pengelolaOrder = PengelolaOrder::find($orderId)->update([
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
        $pengelolaOrder = PengelolaOrder::find($this->orderId);
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
        return view('livewire.dashboard.order-list', [
            'orderList' => $this->getDataOrder(),
        ])->extends('layouts.dashboard', [
            'title' => 'Wisata Order'
        ])->section('main-content');
    }
}
