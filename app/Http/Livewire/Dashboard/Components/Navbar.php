<?php

namespace App\Http\Livewire\Dashboard\Components;

use App\Models\PengelolaEventOrder;
use App\Models\PengelolaOrder;
use App\Models\User;
use App\Models\UserEventOrder;
use App\Models\UserOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $orderCount;
    protected $listeners = ['updateCartCount' => 'mount', 'render'];

    public function mount()
    {
        if (auth()->user()->role_id == 2) {
            $this->orderCount = UserOrder::where('user_id', auth()->user()->id)
                ->where('status', '=', 'pending')
                ->count() + UserEventOrder::where('user_id', auth()->user()->id)
                ->where('status', '=', 'pending')
                ->count();
        } elseif (auth()->user()->role_id == 3) {
            $this->orderCount = PengelolaOrder::where('tour_place_id', auth()->user()->id)->where('status', 'pending')->count() + PengelolaEventOrder::where('event_id', auth()->user()->id)->where('status', 'pending')->count();
        }
    }

    public function logout()
    {
        $userId = auth()->user()->id;
        Auth::logout();
        User::find($userId)->update(['remember_token' => null]);

        redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.dashboard.components.navbar');
    }
}
