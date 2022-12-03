<?php

namespace App\Http\Livewire\Dashboard\Components;

use App\Models\PengelolaOrder;
use App\Models\Role;
use App\Models\UserOrder;
use Livewire\Component;

class Sidebar extends Component
{
    public $orderCount;
    protected $listeners = ['updateCartCount' => 'mount'];

    public function mount()
    {
        if (auth()->user()->role_id == 2) {
            $this->orderCount = UserOrder::where('user_id', auth()->user()->id)->count();
        } elseif (auth()->user()->role_id == 3) {
            $this->orderCount = PengelolaOrder::where('user_id', auth()->user()->id)->count();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.components.sidebar', [
            'roles' => Role::all(),
        ]);
    }
}
