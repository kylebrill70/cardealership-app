<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deleteduser extends Model
{
    use HasFactory;
    protected $table='deleted_users';
    protected $primaryKey='user_id';
    protected $fillable=[
        'full_name',
        'gender_id',
        'address',
        'contact_number',
        'username',
        'password',
        'user_access_id'
    ];

    protected $hidden=['password'];
}
