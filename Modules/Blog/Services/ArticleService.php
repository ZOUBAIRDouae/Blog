<?php

namespace Modules\Blog\Services;

use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Comment;
use Modules\Blog\Models\Tag;
use Modules\Blog\Models\User;



use Illuminate\Support\Facades\Auth;

use Modules\Blog\Requests\ArticleRequest;

class ArticleService
{
    public function index($request)
    {
        $query = Article::query();

        // Count for admin dashboard
        $ArticleCount = Article::count();
        $CommentCount = Comment::count();
        $UserCount = User::count();

        // Filtering
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('tag') && $request->tag != '') {
            $query->whereHas('tags', function ($query) use ($request) {
                $query->where('tags.id', $request->tag);
            });
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // Pagination
        $articles = $query->paginate(10);
        $articles->appends($request->all());

        $categories = Category::all();
        $tags = Tag::all();

        return compact('articles', 'categories', 'tags', 'ArticleCount', 'CommentCount', 'UserCount');
    }

    public function create(ArticleRequest $request)
    {
        $article = Article::create([
            'title' => $request['title'],
            'category_id' => $request['category'],
            'content' => $request['content'],
            'user_id' => Auth::user()->id,
        ]);

        $article->tags()->attach($request->tags);

        return $article;
    }

    public function show($id)
    {
        return Article::with(['category', 'tags', 'comments'])->findOrFail($id);
    }

    public function update($request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'content' => 'required|string',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $article = Article::findOrFail($id);
        $article->update([
            'title' => $validated['title'],
            'category_id' => $validated['category'],
            'content' => $validated['content'],
        ]);

        $article->tags()->sync($validated['tags'] ?? []);

        return $article;
    }

    public function destroy($id)
    {
        $article = Article::where('id', $id);
        $article->delete();
    }
}
