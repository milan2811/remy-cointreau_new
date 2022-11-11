<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $fillable = ["name", "slug", "bar_id", 'drink_id', "description","media", "media_type", "price", "status"];


    // public function terms() {
    //     return $this->hasMany(ItemsRelationship::class, "item_id","id")->with(["category", "ingredient", "brand"]);
    // }

    public function getTerms() {
        $termsCollection = $this->hasMany(ItemsRelationship::class, "item_id","id")->with("term")->get();

        $category = [];
        $ingredients = [];
        $brand = '';
        foreach($termsCollection as $terms) {
            $term = $terms->term;
            if($term) {
                if($term->type == 'category') {
                    $category[] = $term;
                } else if($term->type == 'ingredients') {
                    $ingredients[] = $term;
                } else if($term->type == "brands") {
                    $brand = $term;
                }
            }
        }

        return (object) array(
            'category' => $category,
            'ingredients' => $ingredients,
            // 'brand' => $brand,
        );

        // return $category;

    }

    public function bar() {
        return $this->belongsTo(Bar::class, 'bar_id', 'id');
    }

    public function drink() {
        return $this->belongsTo(Term::class, 'drink_id', 'id');
    }

}
