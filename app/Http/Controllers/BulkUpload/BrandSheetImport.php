<?php

namespace App\Http\Controllers\BulkUpload;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use App\Models\Term;

class BrandSheetImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $brand) {
            
            if(empty($brand['brand']) && empty($brand['product'])) {
                // avoid  empty
            } else if(empty($brand['brand']) && !empty($brand['product'])) {
                $slug = $this->slug($brand['product']);
                Term::updateOrCreate([
                    'slug' => $slug,
                    'type' =>  'products',
                ], [
                    'name' => $brand['product'],
                    'slug' => $slug,
                    'description' => $brand['description'],
                    'type' =>  'products',
                    'picture' => null,
                    'parent' => 0,  
                    'status' => 1
                ]);

            } else {                    
                $name = $brand['brand'];   
                
                $parentBrand = Term::where('parent', 0)->where('name', $name)->first();
                $parent = 0;
                $imageName = null;
                // if (isset($brand['image']) && !empty($brand['image'])) {
                //     // $image = file_get_contents($brand['image']);
                //     // $imageName = time() . '.png';
                //     // file_put_contents(public_path('images/terms/picture/' . $imageName . ''), $image);
                //     $imageName = $brand['image'];
                // }
                if (isset($parentBrand)) {
                    $parent = $parentBrand->id;
                } else {
                    $slug = $this->slug($name);
                    $newBrand = Term::updateOrCreate([
                        'slug' => $slug,
                        'type' =>  'brands',
                        ], [
                        'name' => $name,
                        'slug' => $slug,
                        'description' => $brand['description'],
                        'type' =>  'brands',
                        'picture' => $imageName,
                        'parent' => $parent,
                        'status' => 1
                    ]);
                    $parent = $newBrand->id;
                }

                if (isset($brand['product']) && !empty($brand['product'])) {
                    $slug = $this->slug($brand['product']);
                    Term::updateOrCreate([
                        'slug' => $slug,
                        'type' =>  'brands',
                    ], [
                        'name' => $brand['product'],
                        'slug' => $slug,
                        'description' => $brand['description'],
                        'type' =>  'brands',
                        'picture' => $imageName,
                        'parent' => $parent,
                        'status' => 1
                    ]);
                }
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
