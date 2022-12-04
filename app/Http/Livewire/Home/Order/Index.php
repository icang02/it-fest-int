<?php

namespace App\Http\Livewire\Home\Order;

use App\Models\PengelolaEventOrder;
use App\Models\PengelolaOrder;
use App\Models\TourPlace;
use App\Models\UserEventOrder;
use App\Models\UserOrder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    protected $listeners = [
        'action',
        'render',
        'orderSuccess' => 'orderSuccessHandler'
    ];
    public $image;
    public $order;
    public $orderId;

    public $searchAllOrders = "";
    public $searchGagal = "";
    public $searchSelesai = "";


    public function getOrderId($orderId)
    {
        $this->orderId = $orderId;
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

    public function cancelOrder($orderId, $jenis)
    {
        if ($jenis == 'wisata') {

            $userOrder = UserOrder::find($orderId)->update([
                'status' => 'gagal',
            ]);
            $pengelolaOrder = PengelolaOrder::find($orderId)->update([
                'status' => 'gagal',
            ]);
        } else {
            $userOrder = UserEventOrder::find($orderId)->update([
                'status' => 'gagal',
            ]);
            $pengelolaOrder = PengelolaEventOrder::find($orderId)->update([
                'status' => 'gagal',
            ]);
        }

        if ($userOrder && $pengelolaOrder) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'error',
                'title' => 'Order canceled!',
            ]);
            $this->emit('render');
        }
    }

    public function deleteOrder($orderId, $jenis)
    {
        if ($jenis == 'wisata') {
            $userOrder = UserOrder::find($orderId);
        } elseif ($jenis == 'event') {
            $userOrder = UserEventOrder::find($orderId);
        }

        if ($userOrder->image_tf)
            Storage::delete($userOrder->image_tf);

        $delete = $userOrder->delete();
        if ($delete) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'success',
                'title' => 'Berhasil dihapus!',
            ]);
            $this->emit('render');
        }
    }

    public function uploadImage($jenis)
    {
        $pengelolaOrder = PengelolaOrder::find($this->orderId);
        $userOrder = UserOrder::find($this->orderId);
        $pengelolaEventOrder = PengelolaEventOrder::find($this->orderId);
        $userEventOrder = UserEventOrder::find($this->orderId);

        // dd($this->image);
        $this->validate([
            'image' => 'image|max:4096',
        ]);

        if ($this->image != null) {
            if ($jenis == 'wisata') {
                if ($userOrder->image_tf != null) {
                    Storage::delete($userOrder->image_tf);
                    Storage::delete($pengelolaOrder->image_tf);
                }
            } else {
                if ($userEventOrder->image_tf != null) {
                    Storage::delete($userEventOrder->image_tf);
                    Storage::delete($pengelolaEventOrder->image_tf);
                }
            }

            $imgUser2 = $this->image->store('img/bukti-tf/pengunjung');
            $imgUser3 = $this->image->store('img/bukti-tf/pengelola');
        }

        if ($jenis == 'wisata') {
            $userOrder->update(['image_tf' => $imgUser2]);
            $pengelolaOrder->update(['image_tf' => $imgUser3]);
        } else {
            $userEventOrder->update(['image_tf' => $imgUser2]);
            $pengelolaEventOrder->update(['image_tf' => $imgUser3]);
        }

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
        return view('livewire.home.order.index', [
            'wisataOrder' => UserOrder::where('no_order', 'like', '%' . $this->searchAllOrders . '%')
                ->orWhere('status', 'like', '%' . $this->searchAllOrders . '%')->get(),
            'eventOrder' => UserEventOrder::where('no_order', 'like', '%' . $this->searchAllOrders . '%')
                ->orWhere('status', 'like', '%' . $this->searchAllOrders . '%')->get(),
        ])
            ->extends('layouts.home', ['title' => 'Detail Wisata'])
            ->section('main-content');
    }
}
