<?php

namespace App\Http\Livewire\Home\Wisata;

use App\Models\PengelolaOrder;
use App\Models\TourPlace;
use App\Models\User;
use App\Models\UserOrder;
use Livewire\Component;

class OrderPage extends Component
{
    public $wisataId, $name, $city, $address, $image,
        $qty, $price, $total, $paymentTotal, $noRek, $description;
    public $rental;
    public $wisata;

    protected $listeners = ['action'];

    public function mount()
    {
        $this->wisataId = session('wisataId');
        $this->wisata = TourPlace::find($this->wisataId);
        $noRek = User::find($this->wisata->id)->no_rek;

        $this->rental = $this->wisata->rental;

        $this->name = $this->wisata->name;
        $this->city = $this->wisata->city;
        $this->address = $this->wisata->address;
        $this->image = $this->wisata->image;
        $this->price = $this->wisata->price;
        $this->description = $this->wisata->description;
        $this->noRek = $noRek;

        if ($this->wisata->rental)
            $this->hrgSewaKamera = session('hrgSewaKamera');
        else
            $this->hrgSewaKamera = 0;

        $this->qty = session('qty');
        $this->total = $this->qty * $this->price;
        $this->paymentTotal = $this->total + $this->hrgSewaKamera;
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
        $userOrder = UserOrder::create([
            'no_order' => rand(1, 10000),
            'user_id' => auth()->user()->id,
            'tour_place_id' => $this->wisata->id,
            'quantity' => $this->qty,
            'total_payment' => $this->paymentTotal,
            'status' => 'pending',
        ]);

        $pengelolaOrder = PengelolaOrder::create([
            'no_order' => rand(1, 10000),
            'user_id' => $this->wisata->user_id,
            'tour_place_id' => $this->wisata->id,
            'quantity' => $this->qty,
            'total_payment' => $this->paymentTotal,
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
        return view('livewire.home.wisata.order-page')
            ->extends('layouts.home', ['title' => 'Order'])
            ->section('main-content');
    }
}
