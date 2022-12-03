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

    public function mount()
    {
        // $image = UserOrder::find(1)->image_tf;
        // dd(file_exists('storage/' . $image));
    }

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
        $this->validate([
            'image' => 'image|max:4096',
        ]);

        $imgUser2 = $this->image->store('img/bukti-tf/pengunjung');
        $imgUser3 = $this->image->store('img/bukti-tf/pengelola');

        if ($jenis == 'wisata') {
            UserOrder::find($this->orderId)->update([
                'image_tf' => $imgUser2,
            ]);
            PengelolaOrder::find($this->orderId)->update([
                'image_tf' => $imgUser3,
            ]);
        } else {
            UserEventOrder::find($this->orderId)->update([
                'image_tf' => $imgUser2,
            ]);
            PengelolaEventOrder::find($this->orderId)->update([
                'image_tf' => $imgUser3,
            ]);
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
