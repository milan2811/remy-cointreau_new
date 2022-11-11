<?php

namespace App\Http\Controllers\BulkUpload;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class TermsImport implements WithMultipleSheets
{

    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'category' => new CategorySheetImport(),
            'ingredients' => new IngredientSheetImport(),
            'brands' => new BrandSheetImport(),
            'drink' => new DrinkSheetImport(),
        ];
    }
}
