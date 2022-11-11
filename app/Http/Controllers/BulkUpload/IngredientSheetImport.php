<?php

namespace App\Http\Controllers\BulkUpload;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use App\Models\Term;

class IngredientSheetImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $ingredients) {
            if (isset($ingredients['name']) && !empty($ingredients['name'])) {
                $imageName = null;
                if (isset($ingredients['image']) && !empty($ingredients['image'])) {
                    if(file_exists(public_path('images/terms/picture/' . $ingredients['image']))) {
                        $image = file_get_contents(public_path('images/terms/picture/' . $ingredients['image']));
                        $imageName = time() . '.png';
                        file_put_contents(public_path('images/terms/picture/' . $imageName . ''), $image);                        
                    }
                }
                $slug = $this->slug($ingredients['name']);
                Term::updateOrCreate([
                    'slug' => $slug,
                    'type' =>  'ingredients',
                ],[
                    'name' => $ingredients['name'],
                    'slug' => $slug,
                    'description' => $ingredients['description'],
                    'type' =>  'ingredients',
                    'picture' => $imageName,
                    'status' => 1
                ]);
            }
        }
    }
    public function slug($name)
    {
        $slug = strtolower($name);
        $slug = preg_replace("/\W+/", "-", $slug); // \W = any "non-word" character
        return trim($slug, "-");
    }
}
