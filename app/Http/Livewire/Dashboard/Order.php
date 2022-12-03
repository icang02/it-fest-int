<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\PengelolaOrder;
use App\Models\TourPlace;
use App\Models\UserOrder;
use Livewire\Component;

class Order extends Component
{
    public $wisataId, $name, $city, $address, $image,
        $qty, $price, $hrgSewaKamera, $total, $paymentTotal;
    public $rental;
    public $wisata;

    protected $listeners = ['action'];

    public function mount()
    {
        $this->wisataId = session('wisataId');
        $this->wisata = TourPlace::find($this->wisataId);

        $this->rental = $this->wisata->rental;

        $this->name = $this->wisata->name;
        $this->city = $this->wisata->city;
        $this->address = $this->wisata->address;
        $this->image = $this->wisata->image;
        $this->price = $this->wisata->price;

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
            'text' => 'Please check your item before checkout.',
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
            'user_id' => auth()->user()->id,
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
        return view('livewire.dashboard.order')
            ->extends('layouts.dashboard', [
                'title' => 'Order',
            ])->section('main-content');
    }
}
