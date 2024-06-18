<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partsproduct extends Model
{
    use HasFactory;

    protected $table='parts_product';
    protected $primaryKey='parts_id';
    protected $fillable=[
        'parts_image',
        'parts_name',
        'price',
        'parts_type_id'
    ];
}
