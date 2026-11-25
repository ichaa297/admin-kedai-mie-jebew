<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';

    protected $fillable = [
    'nama',
    'email',
    'role',
    'status',
    'password',
    'hp',
    'foto',
    'tema',
    'warna_utama',
    'warna_latar',
    'font_family',
    'font_color',
    'font_size',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}