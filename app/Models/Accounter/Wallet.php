<?php

namespace App\Models\Accounter;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        "user_id" , "key" , "value"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
