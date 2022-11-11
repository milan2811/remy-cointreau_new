<?php

namespace App\Models;

use App\Models\ItemsRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
    use HasFactory;

    public $fillable = ["name", "slug", "type", "background_color", "description","picture", "parent", "status"];

    public function getAssignTerms() {
        return $this->hasMany(ItemsRelationship::class, "term_id","id")->with("term");
    }

    public function children() {
        return $this->hasMany(Term::class, 'parent', 'id');
    }
}
