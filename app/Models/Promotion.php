<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    public $fillable = ["bar_id", "title", "short_description", "description", "image", "link", "price", "promotion_for"];
}
