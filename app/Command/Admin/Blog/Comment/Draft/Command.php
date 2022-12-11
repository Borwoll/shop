<?php

namespace App\Command\Admin\Blog\Comment\Draft;

use App\Entity\Blog\Comment;

class Command
{
    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}