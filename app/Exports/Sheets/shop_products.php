<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Product\Product;

class shop_products implements FromCollection, WithTitle {
    public function collection() {
        return Product::all();
    }

    public function title(): string {
        return 'shop_products';
    }
}