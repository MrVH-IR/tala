<?php

namespace App\Models\Accounter;

use App\Models\User;
use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Testing\Fluent\Concerns\Has;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "asset_id",
        "type",
        "amount",
        "price",
        "total_money",
        "status",
        "confirmed_by",
        "confirmed_at"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'confirmed_by');
    }
}
