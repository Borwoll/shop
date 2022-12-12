<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Order\DeliveryData;

class shop_order_delivery_data implements FromCollection, WithTitle {
    public function collection() {
        return DeliveryData::all();
    }

    public function title(): string {
        return 'shop_order_delivery_data';
    }
}