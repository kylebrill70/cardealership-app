<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partstype extends Model
{
    use HasFactory;

    protected $table='parts_type';
    protected $primaryKey='parts_type_id';
    protected $fillable=[
        'part_type'
    ];
}
