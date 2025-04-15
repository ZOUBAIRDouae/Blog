@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="my-4 text-primary fw-bold">
        {{ __('Blog::message.manage articles') }}
    </h1>

    <x-admin-chart 
        :ArticleCount="$ArticleCount"
        :UserCount="$UserCount"
        :CommentCount="$CommentCount" 
    />

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('articles.index') }}" class="d-flex">
                        <input type="text" name="search" id="search" class="form-control" 
                            value="{{ request('search') }}" placeholder="{{ __('Blog::message.search') }}">
                        <button type="submit" class="btn btn-outline-primary ms-2">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <div class="col-md-6">
                    <form method="GET" action="{{ route('articles.index') }}" class="d-flex justify-content-end">
                        <select name="category" class="form-select me-2" style="max-width: 180px;">
                            <option value="">{{ __('Blog::message.all categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <select name="tag" class="form-select me-2" style="max-width: 180px;">
                            <option value="">{{ __('Blog::message.all tags') }}</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fas fa-filter"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">{{ __('Blog::message.list of article') }}</h5>
                <div class="d-flex flex-wrap gap-2 justify-content-end align-items-center">

                    <!-- Export CSV (Icon Only) -->
                    <a href="{{ route('article.export', ['format' => 'csv']) }}" class="btn btn-outline-info" title="Exporter CSV">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                
                    <!-- Import Form (Icon Only) -->
                    <form action="{{ route('articles.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                        @csrf
                        <label for="import-file" class="btn btn-warning mb-0" title="Importer un fichier">
                            <i class="fas fa-arrow-up"></i>
                        </label>
                        <input id="import-file" type="file" name="file" class="d-none" onchange="this.form.submit()" required>
                    </form>
                
                    <!-- Add Article (Keep Icon + Text for clarity) -->
                    <a href="{{ route('articles.create') }}" class="btn btn-success d-flex align-items-center">
                        <i class="fas fa-plus me-2"></i> {{ __('Blog::message.add article') }}
                    </a>
                </div>                
            </div>
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>{{ __('Blog::message.title') }}</th>
                        <th>{{ __('Blog::message.category') }}</th>
                        <th>{{ __('Blog::message.post date') }}</th>
                        <th>{{ __('Blog::message.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        @if(
                            (empty(request('category')) || $article->category->id == request('category')) &&
                            ($article->tags->pluck('id')->contains(request('tag')) || !request('tag')) &&
                            (strpos($article->title, request('search')) !== false || strpos($article->content, request('search')) !== false || !request('search'))
                        )
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td class="text-start">{{ $article->title }}</td>
                            <td>{{ $article->category->name }}</td>
                            <td>{{ $article->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('articles.show', $article->id) }}" class="btn btn-outline-secondary btn-sm" title="{{ __('Blog::message.display') }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('update', $article)
                                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-outline-primary btn-sm" title="{{ __('Blog::message.edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('delete', $article)
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="{{ __('Blog::message.delete') }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
@stop
