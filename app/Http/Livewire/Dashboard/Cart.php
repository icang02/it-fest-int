<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Cart as UserCart;
use Livewire\Component;

class Cart extends Component
{
    public $cartId, $qty, $chkboxKamera, $hrgSewaKamera;
    public $cartIdCheckout = 0;

    public function getCartId($cartId)
    {
        $this->cartIdCheckout = $cartId;
    }

    public function toCheckout()
    {
        session()->put('order', UserCart::find($this->cartIdCheckout));
        redirect()->route('cart.order');
    }

    public function editCart($qty)
    {
        $this->qty = $qty;
    }

    public function updateCart($cartId)
    {
        $cart = UserCart::find($cartId);

        if ($this->chkboxKamera == null || $this->chkboxKamera == false) {
            $this->hrgSewaKamera = 0;
            if (is_null($cart->price_kamera)) {
                $this->hrgSewaKamera = null;
            }
        } elseif ($this->chkboxKamera == true) {
            $this->hrgSewaKamera = 50000;
        }

        if ($this->qty > $cart->tour_place->ticket_stock) {
            return $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'error',
                'title' => 'Not enough stock!',
            ]);
        }

        $this->validate(['qty' => 'required']);

        $cart->update([
            'quantity' => $this->qty,
            'total_payment' => ($this->qty * $cart->tour_place->price) + $this->hrgSewaKamera,
            'price_kamera' => $this->hrgSewaKamera,
        ]);
        $this->dispatchBrowserEvent('swal:toast', [
            'type' => 'success',
            'title' => 'Item in cart updated!',
        ]);
    }

    public function deleteInCart($cartId)
    {
        $cart = UserCart::find($cartId)->delete();
        if ($cart) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'error',
                'title' => 'Item deleted!',
            ]);

            $this->emit('updateCartCount');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.cart', [
            'carts' => UserCart::where('user_id', auth()->user()->id)->orderBy('id')->paginate(10)
        ])->extends('layouts.dashboard', [
            'title' => 'Cart',
        ])->section('main-content');
    }
}
