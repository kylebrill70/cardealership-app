<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carproduct extends Model
{
    use HasFactory;

    protected $table='cars';
    protected $primaryKey='cars_id';
    protected $fillable=[
        'cars_image',
        'car_name',
        'engine_name',
        'description',
        'price',
        'car_type_id'
    ];
}
