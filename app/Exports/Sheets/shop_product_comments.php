<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Comment;

class shop_product_comments implements FromCollection, WithTitle {
    public function collection() {
        return Comment::all();
    }

    public function title(): string {
        return 'shop_product_comments';
    }
}