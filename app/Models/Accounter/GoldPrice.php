<?php

namespace App\Models\Accounter;

use Illuminate\Database\Eloquent\Model;

class GoldPrice extends Model
{
    protected $fillable = [
        "price",
        "priced_at"
    ];
}
