<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Shop\Order\Status;

class shop_order_statuses implements FromCollection, WithTitle {
    public function collection() {
        return Status::all();
    }

    public function title(): string {
        return 'shop_order_statuses';
    }
}