<?php

namespace Modules\Blog\App\Imports;

use Modules\Blog\Models\Article;
use Modules\Blog\Controller\ArticleController;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ArticleImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!isset($row['title'], $row['content'], $row['category_id'])) {
            return null; // ignore la ligne invalide
        }
    
        return new Article([
            'title' => $row['title'],
            'content' => $row['content'],
            'category_id' => (int) $row['category_id'],
        ]);
    }
}

