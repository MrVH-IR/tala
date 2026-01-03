<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Admin extends Authenticatable
{
    use HasFactory , Notifiable;

    protected $fillable = ["name" , "last_name" , "email" , "password"];

    protected $hidden = [
        "password",
        "remember_token"
    ];

    protected function casts(): array
    {
        return [
            "password" => "hashed"
        ];
    }
}
