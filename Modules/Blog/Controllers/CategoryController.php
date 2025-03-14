<?php

namespace Modules\Blog\Controllers;

use Modules\Blog\Services\CategoryService;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->getCategories($request);
        return view('Blog::admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('Blog::admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->categoryService->createCategory($request->all());
        return redirect()->route('Blog::categories.index')->with('success', 'Catégorie créée avec succès');
    }

    public function destroy(string $id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect()->route('Blog::categories.index')->with('success', 'Catégorie supprimée avec succès');
    }
}
