<?php

namespace App\Http\Controllers\BulkUpload;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use App\Models\Term;

class CategorySheetImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $cate) {
            if (isset($cate['name']) && !empty($cate['name'])) {
                $imageName = null;
                if (isset($cate['image']) && !empty($cate['image'])) {
                    if(file_exists(public_path('images/terms/picture/' . $cate['image']))) {
                        $image = file_get_contents(public_path('images/terms/picture/' . $cate['image']));
                        $imageName = rand() . '.png';
                        file_put_contents(public_path('images/terms/picture/' . $imageName . ''), $image);
                    }
                }
                $slug = $this->slug($cate['name']);
                Term::updateOrCreate([
                    'slug' => $slug,
                    'type' =>  'category',
                ], [
                    'name' => $cate['name'],
                    'slug' => $slug,
                    'description' => $cate['description'],
                    'type' =>  'category',
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
