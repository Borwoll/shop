<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Region;

class regions implements FromCollection, WithTitle {
    public function collection() {
        return Region::all();
    }

    public function title(): string {
        return 'regions';
    }
}