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
    public $rental;
    public $image;
    public $maps;

    protected $rules = [
        'name' => 'required',
        'city' => 'required',
        'address' => 'required',
        'description' => 'required',
        'telp' => 'required',
        'price' => 'required',
        'ticket_stock' => 'required',
        'rental' => 'required',
        'image' => 'image|max:2048',
        'maps' => 'required',
    ];

    public function storeData()
    {
        $this->validate();

        $image = cloudinary()->upload($this->image->getRealPath(), [
            'folder' => 'wisata'
        ])->getSecurePath();
        $imageId = cloudinary()->getPublicId($image);

        TourPlace::create([
            'id' => auth()->user()->id,
            'name' => str()->title($this->name),
            'city' => str()->title($this->city),
            'address' => str()->title($this->address),
            'description' => ucfirst($this->description),
            'telp' => $this->telp,
            'price' => $this->price,
            'ticket_stock' => $this->ticket_stock,
            'rental' => $this->rental,
            'image' => $image,
            'image_id' => $imageId,
            'maps' => $this->maps,
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
        $this->rental = '';
        $this->image = '';
        $this->maps = '';
    }

    public function render()
    {
        return view('livewire.dashboard.wisata.wisata-add')
            ->extends('layouts.dashboard', ['title' => 'Add'])
            ->section('main-content');
    }
}
