<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Characteristic\Characteristic;

class shop_characteristics implements FromCollection, WithTitle {
    public function collection() {
        return Characteristic::all();
    }

    public function title(): string {
        return 'shop_characteristics';
    }
}