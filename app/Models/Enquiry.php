<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    public $fillable = [
        "name",        
        "email",
        "phone",
        "bar_name",
        "bar_address",
        "bar_city",
        "bar_country",
        "message",
        "status"
    ];
}
