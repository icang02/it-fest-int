<?php

namespace App\Http\Livewire\Dashboard\Event;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PengelolaEdit extends Component
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

    public $event, $eventId;
    public $previewCover;
    public $coverDb;

    public function mount($eventId)
    {
        $this->eventId = $eventId;
        $this->event = Event::find($eventId);

        $this->name = $this->event->name;
        $this->place = $this->event->place;
        $this->description = $this->event->description;
        $this->ticket_stock = $this->event->ticket_stock;
        $this->price = $this->event->price;
        $this->phone = $this->event->phone;
        $this->previewCover = $this->event->cover;
        $this->maps = $this->event->maps;
        $this->query = $this->event->query;
        $this->tgl_mulai = $this->event->tgl_mulai;
        $this->tgl_akhir = $this->event->tgl_akhir;

        $this->coverDb = $this->event->cover;
    }

    public function storeData()
    {
        $cover = Event::find($this->eventId)->cover;
        // dd($this->previewCover);

        $rules = [
            'name' => 'required',
            'place' => 'required',
            'description' => 'required',
            'ticket_stock' => 'required',
            'price' => 'required',
            'phone' => 'required',
            'maps' => 'required',
            'query' => 'required',
            'tgl_mulai' => 'required',
            'tgl_akhir' => 'required',
        ];

        if ($this->cover)
            $rules['cover'] = 'image|max:2048';

        $this->validate($rules);

        if ($this->cover) {
            Storage::delete($cover);
            $cover = $this->cover->store('img/cover-konser');
        }

        $this->event->update([
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

        return redirect('/pengelola-event')->with('success', 'Data berhasil diupdate.');
    }

    public function resetForm()
    {
        $this->name = $this->event->name;
        $this->place = $this->event->place;
        $this->description = $this->event->description;
        $this->ticket_stock = $this->event->ticket_stock;
        $this->price = $this->event->price;
        $this->phone = $this->event->phone;
        $this->cover = $this->event->cover;
        $this->maps = $this->event->maps;
        $this->query = $this->event->query;
        $this->tgl_mulai = $this->event->tgl_mulai;
        $this->tgl_akhir = $this->event->tgl_akhir;
    }

    public function render()
    {
        return view('livewire.dashboard.event.pengelola-edit')
            ->extends('layouts.dashboard', [
                'title' => 'Edit Event',
            ])->section('main-content');
    }
}
