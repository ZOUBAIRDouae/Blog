<?php

namespace Modules\Blog\Services;

use Modules\Blog\Models\Tag;

class TagService
{
    public function getTags(string $search = null, int $perPage = 10)
    {
        $query = Tag::query();
        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        return $query->paginate($perPage);
    }

    public function createTag(array $data)
    {
        return Tag::create($data);
    }

    public function deleteTag(string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
    }
}
