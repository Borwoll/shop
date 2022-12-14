<?php

namespace App\Command\Admin\Blog\Comment\Draft;

use App\Repository\Blog\CommentRepository;

class CommandHandler
{
    private $comments;

    public function __construct(CommentRepository $comments)
    {
        $this->comments = $comments;
    }

    public function __invoke(Command $command)
    {
        $this->comments->draft($command->comment);
    }
}