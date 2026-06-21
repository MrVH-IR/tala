<?php

namespace App\Models\Accounter;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ZarinpalResponse extends Model
{

    protected $fillable = [
        'user_id',
        'authority',
        'amount',
        'fee',
        'fee_type',
        'code',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
