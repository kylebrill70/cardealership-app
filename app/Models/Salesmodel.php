<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesmodel extends Model
{
    use HasFactory;
    protected $table='sales';
    protected $primaryKey='sales_id';
    protected $fillable=[
        'product_name',
        'quantity',
        'price',
        'amount',
        'change'
    ];
}

