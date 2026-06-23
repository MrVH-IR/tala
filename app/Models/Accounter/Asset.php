<?php

namespace App\Models\Accounter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    protected $fillable = [
        'symbol',
        'name',
        'category',
    ];

    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }
}
