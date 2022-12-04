<?php

namespace App\Http\Livewire\Dashboard\Wisata;

use App\Models\TourPlace;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class WisataEdit extends Component
{
    use WithFileUploads;
    public $wisata;
    public $placeId;
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

    public $imageNew;

    public function mount($id)
    {
        $this->wisata = TourPlace::find($id);
        $this->placeId = $id;

        $this->name = $this->wisata->name;
        $this->city = $this->wisata->city;
        $this->address = $this->wisata->address;
        $this->description = $this->wisata->description;
        $this->telp = $this->wisata->telp;
        $this->price = $this->wisata->price;
        $this->ticket_stock = $this->wisata->ticket_stock;
        $this->maps = $this->wisata->maps;
        $this->query = $this->wisata->query;
        $this->image = $this->wisata->image;

        $this->imageNew = $this->wisata->image;
    }

    public function updateData()
    {
        $image = TourPlace::find($this->placeId)->image;
        // dd($imageLama == $this->image);
        $rules = [
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'description' => 'required',
            'telp' => 'required',
            'price' => 'required',
            'ticket_stock' => 'required',
            'maps' => 'required',
            'query' => 'required',
        ];

        if ($image != $this->image) {
            $rules['image'] = 'image|max:2048';
            Storage::delete($image);
            $image = $this->image->store('img/wisata');
        }
        $this->validate($rules);

        TourPlace::find($this->placeId)->update([
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

        return redirect()->route('wisata')->with('success', 'Updated data successfully.');
    }

    public function resetForm()
    {
        $this->name = $this->wisata->name;
        $this->city = $this->wisata->city;
        $this->address = $this->wisata->address;
        $this->description = $this->wisata->description;
        $this->telp = $this->wisata->telp;
        $this->price = $this->wisata->price;
        $this->ticket_stock = $this->wisata->ticket_stock;
        $this->image = $this->image;
        $this->maps = $this->wisata->maps;
        $this->query = $this->wisata->query;
    }

    public function render()
    {
        return view('livewire.dashboard.wisata.wisata-edit')
            ->extends('layouts.dashboard', ['title' => 'Edit'])
            ->section('main-content');
    }
}
