<?php

namespace App\Models\Accounter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    protected $fillable = [
        'category',
        'symbol',
        'name',
        'unit',
        'precision',
        'is_active',
    ];

    public function marketPrices(): HasMany
    {
        return $this->hasMany(MarketPrice::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }
}
