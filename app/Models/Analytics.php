<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;

    public $fillable = [
        "object_id",
        "count",
        "page_url",
        "bar_id",
        "ip_address",
        "device",
        "type",
        "total_count",
        "created_at",
    ];


    public function item() {
        return $this->belongsTo(Item::class, 'object_id', 'id');
    }

    public function term() {
        return $this->belongsTo(Term::class, 'object_id', 'id');
    }

    public function bar() {
        return $this->belongsTo(Bar::class, 'object_id', 'id');
    }
}
