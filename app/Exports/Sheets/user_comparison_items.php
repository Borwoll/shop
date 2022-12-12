<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\User\ComparisonItem;

class user_comparison_items implements FromCollection, WithTitle {
    public function collection() {
        return ComparisonItem::all();
    }

    public function title(): string {
        return 'user_comparison_items';
    }
}