<?php

namespace App\Http\Livewire\Dashboard\Wisata;

use App\Models\TourPlace;
use Livewire\Component;
use Livewire\WithFileUploads;

class WisataAdd extends Component
{
    use WithFileUploads;
    public $name;
    public $city;
    public $address;
    public $description;
    public $telp;
    public $price;
    public $ticket_stock;
    public $image;
    public $maps;
    public $query;

    protected $rules = [
        'name' => 'required',
        'city' => 'required',
        'address' => 'required',
        'description' => 'required',
        'telp' => 'required',
        'price' => 'required',
        'ticket_stock' => 'required',
        'image' => 'image|max:2048',
        'maps' => 'required',
        'query' => 'required',
    ];

    public function storeData()
    {
        $this->validate();

        $image = $this->image->store('img/wisata');

        TourPlace::create([
            'id' => auth()->user()->id,
            'name' => str()->title($this->name),
            'city' => str()->title($this->city),
            'address' => str()->title($this->address),
            'description' => ucfirst($this->description),
            'telp' => $this->telp,
            'price' => $this->price,
            'ticket_stock' => $this->ticket_stock,
            'image' => $image,
            'maps' => $this->maps,
            'query' => $this->query,
        ]);

        return redirect()->route('wisata')->with('success', 'Added data successfully.');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->city = '';
        $this->address = '';
        $this->description = '';
        $this->telp = '';
        $this->price = '';
        $this->ticket_stock = '';
        $this->image = '';
        $this->maps = '';
        $this->query = '';
    }

    public function render()
    {
        return view('livewire.dashboard.wisata.wisata-add')
            ->extends('layouts.dashboard', ['title' => 'Add'])
            ->section('main-content');
    }
}
