@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')
    <div class="container mx-auto py-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Libros aleatorios</h2>
            <div class="flex flex-wrap justify-center">
                @foreach ($randomBooks as $book)
                    <li>{{ $book['volumeInfo']['title'] }}</li>
                    <div class="h-48 w-full object-cover rounded-lg overflow-hidden bg-red-400 cursor-pointer rounded-xl relative group">
                        <a href="{{route('book.show', $book['id'])}}">
                            <img class="h-48 w-full object-cover rounded-lg shadow-md group-hover:scale-110 transition duration-300 ease-in-out" src="{{ $book['volumeInfo']['imageLinks']['smallThumbnail'] }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Últimas noticias</h2>
            @foreach($latestNews as $news)
            <div class="bg-white rounded-lg shadow-lg mb-4">
                <div class="p-4">
                    <h3 class="font-bold text-lg">{{$news['title']}}</h3>
                    
                    <p class="mt-2">{{$news['description']}}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div>
            <h2 class="text-2xl font-bold mb-4">Últimas reseñas de usuarios</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($latestReviews as $review)
                    <div class="mb-3">
                        <h5 class="card-title">{{ $review->book_name }}</h5>
                        
                        <p class="card-text">{{ $review->body }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $review->user->name}}</h6>
                    </div>
                @empty
                    <p>No hay reseñas aún.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection