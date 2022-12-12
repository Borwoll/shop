<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Blog\Category;

class blog_categories implements FromCollection, WithTitle {
    public function collection() {
        return Category::all();
    }

    public function title(): string {
        return 'blog_categories';
    }
}