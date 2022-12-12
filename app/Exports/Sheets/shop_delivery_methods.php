<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\DeliveryMethod;

class shop_delivery_methods implements FromCollection, WithTitle {
    public function collection() {
        return DeliveryMethod::all();
    }

    public function title(): string {
        return 'shop_delivery_methods';
    }
}