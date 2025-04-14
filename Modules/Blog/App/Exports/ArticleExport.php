<?php

namespace Modules\Blog\App\Exports;

use Modules\Blog\Models\Article;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArticleExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Article::all();
    }
}
