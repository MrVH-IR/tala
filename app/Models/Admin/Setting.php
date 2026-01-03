<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        "images", "texts" , "menu" , "menu_links"
    ];

    protected function casts(): array
    {
        return [
            "images" => "array" ,
            "texts"  => "array",
            "menu"   => "array",
            "menu_links" => "array",
        ];
    }
}
