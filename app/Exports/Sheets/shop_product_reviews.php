<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Review;

class shop_product_reviews implements FromCollection, WithTitle {
    public function collection() {
        return Review::all();
    }

    public function title(): string {
        return 'shop_product_reviews';
    }
}