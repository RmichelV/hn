<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_type extends Model
{
    /** @use HasFactory<\Database\Factories\RoomTypeFactory> */
    use HasFactory;

    protected $table = 'room_types';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'room_image',
    ];
    public $timestamp = false;

    public function room(){
        return $this->hasMany( Room::class, 'room_type_id', 'id');
    }

}
