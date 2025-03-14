<?php

namespace Modules\Blog\Services;

use Modules\Blog\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{
    public function getCategories(Request $request)
    {
        $query = Category::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return $query->paginate(10);
    }

    public function createCategory(array $data)
    {
        return Category::create([
            'name' => $data['name'],
        ]);
    }

    public function deleteCategory(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }
}
