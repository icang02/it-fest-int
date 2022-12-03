<?php

namespace App\Http\Livewire\Dashboard\Event;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads;

class PengelolaAdd extends Component
{
    use WithFileUploads;
    public $name;
    public $place;
    public $description;
    public $ticket_stock;
    public $price;
    public $phone;
    public $cover;
    public $maps;
    public $query;
    public $tgl_mulai;
    public $tgl_akhir;

    protected $rules = [
        'name' => 'required',
        'place' => 'required',
        'description' => 'required',
        'ticket_stock' => 'required',
        'price' => 'required',
        'phone' => 'required',
        'cover' => 'image|max:2048',
        'maps' => 'required',
        'query' => 'required',
        'tgl_mulai' => 'required',
        'tgl_akhir' => 'required',
    ];

    public function storeData()
    {
        $this->validate();

        $cover = $this->cover->store('img/cover-konser');
        Event::create([
            'user_id' => auth()->user()->id,
            'name' => ucfirst($this->name),
            'place' => ucfirst($this->place),
            'description' => ucfirst($this->description),
            'ticket_stock' => $this->ticket_stock,
            'price' => $this->price,
            'phone' => $this->phone,
            'cover' => $cover,
            'maps' => $this->maps,
            'query' => $this->query,
            'tgl_mulai' => $this->tgl_mulai,
            'tgl_akhir' => $this->tgl_akhir,
        ]);

        return redirect('/pengelola-event')->with('success', 'Added data successfully.');
    }

    public function resetForm()
    {
        $this->name = "";
        $this->place = "";
        $this->description = "";
        $this->ticket_stock = "";
        $this->price = "";
        $this->phone = "";
        $this->cover = "";
        $this->maps = "";
        $this->query = "";
        $this->tgl_mulai = "";
        $this->tgl_akhir = "";
    }

    public function render()
    {
        return view('livewire.dashboard.event.pengelola-add')
            ->extends('layouts.dashboard', [
                'title' => 'Event',
            ])->section('main-content');
    }
}
