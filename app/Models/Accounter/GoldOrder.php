<?php

namespace App\Models\Accounter;

use App\Models\User;
use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Model;

class GoldOrder extends Model
{
    protected $fillable = ["user_id" , "type" , "gold_amount" , "gold_price",
                "money_amount" , "status" , "confirmed_by" , "confirmed_at"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function confirmedBy()
    {
        return $this->belongsTo(Admin::class , 'confirmed_by' , 'id');
    }
}
