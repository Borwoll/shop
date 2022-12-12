<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Blog\Post\Post;

class blog_posts implements FromCollection, WithTitle {
    public function collection() {
        return Post::all();
    }

    public function title(): string {
        return 'blog_posts';
    }
}