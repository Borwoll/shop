<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Order\Order;

class shop_orders implements FromCollection, WithTitle {
    public function collection() {
        return Order::all();
    }

    public function title(): string {
        return 'shop_orders';
    }
}