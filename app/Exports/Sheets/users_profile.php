<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\User\Profile;

class users_profile implements FromCollection, WithTitle {
    public function collection() {
        return Profile::all();
    }

    public function title(): string {
        return 'users_profile';
    }
}