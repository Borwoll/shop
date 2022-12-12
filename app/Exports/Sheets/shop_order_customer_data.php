<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Order\CustomerData;

class shop_order_customer_data implements FromCollection, WithTitle {
    public function collection() {
        return CustomerData::all();
    }

    public function title(): string {
        return 'shop_order_customer_data';
    }
}