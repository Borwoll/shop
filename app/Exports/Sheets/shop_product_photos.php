<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Product\Photo;

class shop_product_photos implements FromCollection, WithTitle {
    public function collection() {
        return Photo::all();
    }

    public function title(): string {
        return 'shop_product_photos';
    }
}