<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessType extends Model
{
    use HasFactory;
    protected $table='access_type';
    protected $primaryKey='user_access_id';
    protected $fillable=[
        'user_access_type'
    ];
}
