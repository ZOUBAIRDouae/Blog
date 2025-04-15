@extends('layouts.public')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Nos Articles</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
        @foreach ($articles as $article)
        <div class="bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition duration-300 border border-gray-100">
            <div class="p-6 flex flex-col h-full">
                <!-- Titre de l'article -->
                <a href="{{ route('public.show', $article->id) }}" class="group">
                    <h2 class="text-xl font-bold text-gray-800 group-hover:text-indigo-600 transition-colors duration-200 mb-4">
                        {{ $article->title }}
                    </h2>
                </a>

                <!-- Tags + Catégorie -->
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach ($article->tags as $tag)
                        <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-3 py-1 rounded-full">
                            #{{ $tag->name }}
                        </span>
                    @endforeach

                    @if ($article->category)
                        <span class="bg-emerald-100 text-emerald-800 text-xs font-medium px-3 py-1 rounded-full">
                            {{ $article->category->name }}
                        </span>
                    @endif
                </div>

                <!-- Contenu court -->
                <p class="text-gray-600 text-sm mb-6 flex-grow line-clamp-4 leading-relaxed">
                    {!! $article->content !!}
                </p>

                <!-- Bouton Lire Plus -->
                <div class="mt-auto">
                    <a href="{{ route('public.show', $article->id) }}"
                       class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                        Lire l’article
                        <svg class="w-4 h-4 ml-2 rtl:rotate-180" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
