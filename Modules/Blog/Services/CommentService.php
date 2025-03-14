<?php

namespace Modules\Blog\Services;

use Modules\Blog\Models\Comment;

class CommentService
{
    public function createComment(array $data)
    {
        return Comment::create($data);
    }

    public function deleteComment(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
    }
}
