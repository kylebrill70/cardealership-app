<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartmodel extends Model
{
    use HasFactory;

    protected $table='cart';
    protected $primaryKey='cart_id';
    protected $fillable=[
        'quantity',
        'parts_name',
        'price'
    ];
}
