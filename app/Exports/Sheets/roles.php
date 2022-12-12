<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class roles implements FromCollection, WithTitle {
    public function collection() {
        return DB::table('roles')->get();;
    }

    public function title(): string {
        return 'roles';
    }
}