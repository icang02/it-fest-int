<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class OrderCart extends Component
{
    public $cart;

    public function mount()
    {
        $this->cart = session('order');
    }

    public function render()
    {
        return view('livewire.dashboard.order-cart')
            ->extends('layouts.dashboard', [
                'title' => 'Checkout',
            ])->section('main-content');
    }
}
