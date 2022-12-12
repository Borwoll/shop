<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Category;

class shop_categories implements FromCollection, WithTitle {
    public function collection() {
        return Category::all();
    }

    public function title(): string {
        return 'shop_categories';
    }
}