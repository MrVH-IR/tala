<?php

namespace App\Models\Accounter;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class WalletTransaction extends Model
{
    protected $fillable = [
        'wallet_id',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'description',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function user(): WalletTransaction|HasOneThrough
    {
        return $this->hasOneThrough(
            User::class,
            Wallet::class,
            'id',        // wallets.id
            'id',        // users.id
            'wallet_id', // wallet_transactions.wallet_id
            'user_id'    // wallets.user_id
        );
    }
}
