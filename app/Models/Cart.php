<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function tour_place()
    {
        return $this->belongsTo(TourPlace::class);
    }
}
