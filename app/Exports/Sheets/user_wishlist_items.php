<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\User\WishlistItem;

class user_wishlist_items implements FromCollection, WithTitle {
    public function collection() {
        return WishlistItem::all();
    }

    public function title(): string {
        return 'user_wishlist_items';
    }
}