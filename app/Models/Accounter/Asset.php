<?php

namespace App\Models\Accounter;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'symbol',
        'name',
        'category',
    ];
}
