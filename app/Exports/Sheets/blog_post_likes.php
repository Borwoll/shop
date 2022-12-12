<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Blog\Post\Like;

class blog_post_likes implements FromCollection, WithTitle {
    public function collection() {
        return Like::all();
    }

    public function title(): string {
        return 'blog_post_likes';
    }
}