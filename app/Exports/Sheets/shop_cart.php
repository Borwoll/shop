<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Cart\CartItem;

class shop_cart implements FromCollection, WithTitle {
    public function collection() {
        return CartItem::all();
    }

    public function title(): string {
        return 'shop_cart';
    }
}