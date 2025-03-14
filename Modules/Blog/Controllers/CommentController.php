<?php

namespace Modules\Blog\Controllers;

use Modules\Blog\Services\CommentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string',
        ]);

        $this->commentService->createComment($validated);
        return redirect()->back()->with('success', 'Commentaire créé avec succès');
    }

    public function destroy(string $id)
    {
        $this->commentService->deleteComment($id);
        return redirect()->back()->with('success', 'Commentaire supprimé avec succès');
    }
}
