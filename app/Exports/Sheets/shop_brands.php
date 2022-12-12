<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Brand;

class shop_brands implements FromCollection, WithTitle {
    public function collection() {
        return Brand::all();
    }

    public function title(): string {
        return 'shop_brands';
    }
}