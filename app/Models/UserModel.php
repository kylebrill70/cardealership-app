<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'full_name',
        'gender_id',
        'address',
        'contact_number',
        'username',
        'password',
        'user_access_id'
    ];

    protected $hidden = ['password'];
}
