<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'image_path',
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
