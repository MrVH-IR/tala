<?php

namespace App\Models\Accounter;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletTransaction extends Model
{
    use HasFactory;


    protected $fillable = ['user_id' , 'wallet_id' , 'type' , 'amount' , 'source_type' , 'source_id' , 'description' , 'created_by'];


    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
