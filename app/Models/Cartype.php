<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartype extends Model
{
    use HasFactory;

    protected $table='car_type';
    protected $primaryKey='car_type_id';
    protected $fillable=[
        'car_type'
    ];
}
