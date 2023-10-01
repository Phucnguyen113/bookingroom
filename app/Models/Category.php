<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'categories_blogs');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'categories_rooms');
    }
}
