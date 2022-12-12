<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Characteristic\Variant;

class shop_characteristic_variants implements FromCollection, WithTitle {
    public function collection() {
        return Variant::all();
    }

    public function title(): string {
        return 'shop_characteristic_variants';
    }
}