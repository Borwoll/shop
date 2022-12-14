<?php

namespace App\UseCases\Admin\Blog;

use App\Entity\Blog\Comment;
use App\Http\Requests\Admin\Blog\Post\Comment\UpdateRequest;
use App\Query\Blog\Post\Comment\Find\FindCommentsQuery;
use App\Command\Admin\Blog\Comment\Activate\Command as CommentActivateCommand;
use App\Command\Admin\Blog\Comment\Remove\Command as CommentRemoveCommand;
use App\Command\Admin\Blog\Comment\Draft\Command as CommentDraftCommand;
use App\UseCases\Service;

class CommentManageService extends Service
{
    public function remove(Comment $comment): void
    {
        $this->commandBus->handle(new CommentRemoveCommand($comment));
    }

    public function activate(Comment $comment): void
    {
        $this->commandBus->handle(new CommentActivateCommand($comment));
    }

    public function draft(Comment $comment): void
    {
        $this->commandBus->handle(new CommentDraftCommand($comment));
    }

    public function getComments()
    {
        $users = $this->queryBus->query(new FindCommentsQuery());
        return $users;
    }
}