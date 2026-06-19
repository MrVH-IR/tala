<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCreditCardInformation extends Model
{
    protected $table = 'user_credit_card_informations';

    protected $fillable = [
        'user_id',
        'card_number',
        'sheba',
        'is_default',
        'admins_message',
        'message_read_at',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'is_default' => 'boolean',
            'verified_at' => 'datetime',
            'message_read_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
