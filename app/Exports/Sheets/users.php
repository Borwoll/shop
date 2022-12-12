<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\User\User;

class users implements FromCollection, WithTitle {
    public function collection() {
        return User::all();
    }

    public function title(): string {
        return 'users';
    }
}