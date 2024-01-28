<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'room_id',
        'room_type',
        'min_price',
        'max_price',
        'province',
        'district',
        'bedroom',
        'bathroom',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
