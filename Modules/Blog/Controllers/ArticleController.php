<?php

namespace Modules\Blog\Controllers;

use App\Http\Controllers\Controller;

use Modules\Blog\Models\Article;
use Modules\Blog\Models\Tag;
use Modules\Blog\Models\Category;


use Modules\Blog\Services\ArticleService;
use Modules\Blog\Requests\ArticleRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $data = $this->articleService->index($request);
        
        if (Auth::check() && Auth::user()->roles->contains('name', 'admin')) {
            return view('Blog::admin.article.index', $data);
        } else {
            return view('Blog::public.index', $data);
        }
    }

    public function create()
    {
        if (!Auth::check() || !Auth::user()->roles->contains('name', 'admin')) {
            return redirect()->route('articles.index');
        }

        $categories = Category::all();
        $allTags = Tag::all();

        return view('Blog::admin.article.create', compact('categories', 'allTags'));
    }

    public function store(ArticleRequest $request)
    {
        if (!Auth::check() || !Auth::user()->roles->contains('name', 'admin')) {
            return redirect()->route('articles.index');
        }

        $this->articleService->create($request);

        return redirect()->route('articles.index')->with('success', 'L\'article a bien été créé');
    }

    public function show(string $id)
    {
        $article = $this->articleService->show($id);
        $commentableId = $article->id;
        $commentableType = Article::class;

        if (Auth::check() && Auth::user()->roles->contains('name', 'admin')) {
            return view('Blog::admin.article.show', compact('article', 'commentableId', 'commentableType'));
        } else {
            return view('Blog::public.show', compact('article', 'commentableId', 'commentableType'));
        }
    }

    public function edit($id)
    {
        if (!Auth::check() || !Auth::user()->roles->contains('name', 'admin')) {
            return redirect()->route('Blog::articles.index');
        }

        $article = Article::findOrFail($id);
        $this->authorize('edit', $article);
        $categories = Category::all();
        $allTags = Tag::all();
        $selectedTags = $article->tags->pluck('id')->toArray();

        return view('Blog::admin.article.edit', compact('article', 'categories', 'allTags', 'selectedTags'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check() || !Auth::user()->roles->contains('name', 'admin')) {
            return redirect()->route('Blog::articles.index');
        }

        $this->articleService->update($request, $id);

        return redirect()->route('Blog::articles.index')->with('success', 'L\'article a bien été modifié');
    }

    public function destroy(string $id)
    {
        if (!Auth::check() || !Auth::user()->roles->contains('name', 'admin')) {
            return redirect()->route('Blog::articles.index');
        }

        $this->articleService->destroy($id);

        return redirect()->route('articles.index')->with('success', 'L\'article a bien été supprimé');
    }
}
