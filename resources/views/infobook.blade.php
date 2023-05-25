@extends('layouts.app')

@section('contenido')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">{{ $book->volumeInfo->title }}</h1>
    <div class="flex flex-wrap justify-center items-start">
        <div class="w-1/3 pr-8">
            <img class="rounded-lg shadow-md mb-4" src="{{ $book->volumeInfo->imageLinks->thumbnail }}" alt="{{ $book->volumeInfo->title }}">
        </div>
        <div class="w-2/3">
            @if (isset($book->volumeInfo->authors))
                <p class="text-lg font-bold mb-2">Autor(es): {{ implode(', ', $book->volumeInfo->authors) }}</p>
            @endif
            <p class="text-lg font-bold mb-2">Editorial: {{ $book->volumeInfo->publisher }}</p>
            <p class="text-lg font-bold mb-2">Fecha de publicación: {{ $book->volumeInfo->publishedDate }}</p>
            <p class="text-lg font-bold mb-2">Páginas: {{ $book->volumeInfo->pageCount }}</p>
            <p class="text-lg font-bold mb-2">Descripción:</p>
            @if (isset($book->volumeInfo->description))
                <p class="text-lg mb-2">{!! $book->volumeInfo->description !!}</p>
            @endif
            <div class="mt-6">
                <a href="{{ $book->volumeInfo->previewLink }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ver en Google Books</a>
            </div>
                        
            @auth
                <form method="POST" action="{{ route('favorites.store', $book->id) }}" class="mt-4">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Agregar a Favoritos
                    </button>
                </form>

                
                @if ($userHasReview)
                    <p class="mt-6 text-gray-500 italic">Ya has realizado una reseña para este libro.</p>
                @else
                    <div class="mt-6">
                        <a href="{{ route('reviews.create', $book->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Hacer reseña</a>
                    </div>
                @endif
                
                
            @endauth
        </div>
    </div>
</div>
@endsection
