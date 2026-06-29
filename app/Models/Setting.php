<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable = [
        'active',
        'route',
        'title',
    ];

    protected function casts()
    {
        return [
            'active' => 'boolean',
        ];
    }
}
