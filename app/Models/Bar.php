<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    use HasFactory;

    public $fillable = [
        "name",
        "slug",
        "logo",
        "background_color",
        "description",
        "user_id",
        "images",
        "location",
        "country",
        "city",
        "fonts",
        "font_color",
        "font_size",
        "type",
        "settings",
        "show_brand",
        "status",
    ];


    public function owner()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function font()
    {
        return $this->belongsTo(Font::class, "fonts", "id");
    }
    public function getCountry()
    {
        return $this->belongsTo(Country::class, "country", "id");
    }
    public function getSettingsAttribute($value) {
        return json_decode($value);
    }
}
