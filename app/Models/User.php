<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'FirstName', 
        'LastName', 
        'Email', 
        'PhoneNumber', 
        'Password', 
        'ProfilePicture'
    ];

    protected $hidden = [
        'Password', 
        'remember_token',
    ];
}
