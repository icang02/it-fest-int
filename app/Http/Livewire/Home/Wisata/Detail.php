<?php

namespace App\Http\Livewire\Home\Wisata;

use App\Models\TourPlace;
use Livewire\Component;

class Detail extends Component
{
    public $wisata, $qty, $paymentTotal;

    public function mount($wisataId)
    {
        $this->wisata = TourPlace::find($wisataId);
    }

    public function rules()
    {
        return [
            'qty' => 'required|numeric|max:' . $this->wisata->ticket_stock,
        ];
    }

    public function submitToOrder($wisataId)
    {
        if ($this->qty == null) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'error',
                'title' => 'Minimal pesan 1 tiket!',
            ]);
        } else if ($this->qty > $this->wisata->ticket_stock) {
            $this->dispatchBrowserEvent('swal:toast', [
                'type' => 'error',
                'title' => 'Stok tiket tidak cukup!',
            ]);
        }
        // Validasi data
        $this->validate();

        session()->put('wisataId', $wisataId);
        session()->put('qty', $this->qty);

        return redirect("semua-wisata/order/$wisataId");
    }

    public function render()
    {
        return view('livewire.home.wisata.detail')
            ->extends('layouts.home', ['title' => 'Detail Wisata'])
            ->section('main-content');
    }
}
