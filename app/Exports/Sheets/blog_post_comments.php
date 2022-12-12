<?php
namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Entity\Blog\Comment;

class blog_post_comments implements FromCollection, WithTitle {
    public function collection() {
        return Comment::all();
    }

    public function title(): string {
        return 'blog_post_comments';
    }
}