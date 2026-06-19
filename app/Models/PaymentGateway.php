<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentGateway extends Model
{
    protected $fillable = ['data', 'user_id', 'status'];

    protected function casts(): array
    {
        return [
            'data' => 'json',
        ];
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
