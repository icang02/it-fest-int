<?php

namespace App\Http\Livewire\Dashboard\Wisata;

use App\Models\TourPlace;
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
    public $rental;
    public $image;
    public $imageId;
    public $maps;

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
        $this->rental = $this->wisata->rental;
        $this->maps = $this->wisata->maps;

        $this->imageNew = $this->wisata->image;
        $this->imageId = $this->wisata->image_id;
    }

    public function updateData()
    {
        $rules = [
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'description' => 'required',
            'telp' => 'required',
            'price' => 'required',
            'ticket_stock' => 'required',
            'rental' => 'required',
            'maps' => 'required',
        ];

        if ($this->image !== null) {
            $rules['image'] = 'image|max:2048';
        }
        $this->validate($rules);

        $image = $this->imageNew;
        $imageId = $this->imageId;
        if ($this->image !== null) {
            $image = cloudinary()->upload($this->image->getRealPath(), [
                'folder' => 'wisata'
            ])->getSecurePath();

            if ($imageId !== null)
                cloudinary()->destroy($this->imageId);
            $imageId = cloudinary()->getPublicId($image);
        }

        TourPlace::find($this->placeId)->update([
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
        $this->rental = $this->wisata->rental;
        $this->image = null;
        $this->maps = $this->wisata->maps;
    }

    public function render()
    {
        return view('livewire.dashboard.wisata.wisata-edit')
            ->extends('layouts.dashboard', ['title' => 'Edit'])
            ->section('main-content');
    }
}
