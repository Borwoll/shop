<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Order\OrderItem;

class shop_order_items implements FromCollection, WithTitle {
    public function collection() {
        return OrderItem::all();
    }

    public function title(): string {
        return 'shop_order_items';
    }
}