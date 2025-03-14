<?php

namespace Modules\Blog\Controllers;

use Modules\Blog\Services\TagService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index(Request $request)
    {
        $tags = $this->tagService->getTags($request->search ?? '');
        return view('Blog::admin.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('Blog::admin.tag.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->tagService->createTag($validated);
        return redirect()->route('Blog::tags.index')->with('success', 'Le tag a bien été créé');
    }

    public function destroy(string $id)
    {
        $this->tagService->deleteTag($id);
        return redirect()->route('Blog::tags.index')->with('success', 'Le tag a bien été supprimé');
    }
}
