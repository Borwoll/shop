<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class role_users implements FromCollection, WithTitle {
    public function collection() {
        return DB::table('role_users')->get();;
    }

    public function title(): string {
        return 'role_users';
    }
}