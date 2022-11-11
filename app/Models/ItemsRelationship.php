<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemsRelationship extends Model
{
    use HasFactory;

    public $fillable = ["item_id", "term_id", "row_no"];

    // public function category() {
    //     return $this->belongsTo(Term::class, "term_id", "id")->where('type','category');
    // }

    // public function ingredient() {
    //     return $this->belongsTo(Term::class, "term_id", "id")->where('type','ingredients');
    // }

    // public function brand() {
    //     return $this->belongsTo(Term::class, "term_id", "id")->where('type','brands');
    // }

    public function term()
    {
        return $this->belongsTo(Term::class, "term_id", "id");
    }

    public function items()
    {
        return $this->belongsTo(Item::class, "item_id", "id");
    }
}
