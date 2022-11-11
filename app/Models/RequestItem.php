<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    use HasFactory;

    public $fillable = [
        "username",
        "email",
        "bar_id",
        "object_id",
        "subject",
        "message",
        "status",
        "request_for"
    ];

    public function bar() {
        return $this->belongsTo(Bar::class);
    }

    public function object() {
        if($this->request_for == 'item') {
            return $this->belongsTo(Item::class, 'object_id', 'id');
        } else {
            return $this->belongsTo(Term::class, 'object_id', 'id');
        }
    }

}
