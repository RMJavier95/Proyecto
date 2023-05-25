@extends('layouts.app')

@section('titulo')

    
    
@endsection

@section('contenido')
    <div class="container mx-auto py-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Últimos libros</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
              @foreach ($randomBooks as $book)
                <div class="w-full mx-auto">
                  <h1>{{ $book['volumeInfo']['title'] }}</h1>
                  <div class="shadow-lg h-64 w-40 sm:w-48 md:w-56 lg:w-64 xl:w-72 object-cover rounded-lg overflow-hidden bg-red-400 cursor-pointer rounded-xl relative group">
                    <a href="{{route('book.show', $book['id'])}}">
                      <img class="h-full w-full object-cover rounded-lg shadow-md group-hover:scale-110 transition duration-300 ease-in-out" src="{{ $book['volumeInfo']['imageLinks']['smallThumbnail'] }}" alt="{{ $book['volumeInfo']['title'] }}">
                    </a>
                  </div>
                </div>
              @endforeach
            </div>
        </div>
          
          
          
        <div class="mb-8 mt-32">
            <h2 class="text-2xl font-bold mb-4">Últimas noticias</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
              @foreach($latestNews as $news)
              <div class="bg-white rounded-lg shadow-lg">
                <a href="{{$news['link']}}">
                    <div class="relative">
                      <img class="w-full h-80 object-cover rounded-lg group-hover:scale-110 transition duration-300 ease-in-out" src="{{$news['image']}}" alt="{{$news['title']}}">
                      <div class="absolute inset-0 bg-black opacity-25 rounded-lg"></div>
                      <div class="absolute inset-0 flex items-center justify-center">
                        <h3 class="font-bold text-lg text-white m-3 p-3">{{$news['title']}}</h3>
                      </div>
                  </div>
                </a>
              </div>
              @endforeach
            </div>
        </div>
          
          
        <div class="mt-32">
            <h2 class="text-2xl font-bold mb-4">Reseñas de usuarios</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 bg-gray-300 rounded-lg shadow-lg">
                @forelse($latestReviews as $review)
                    <div class="m-3 p-3 bg-gray-100 rounded-lg shadow-lg">
                        <h5 class="card-title">{{ $review->book_name }}</h5>
                        <br>
                        <p class="card-text"><em><q>{{ $review->body }}</q></em></p>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $review->user->name}}</h6>
                    </div>
                @empty
                    <p>No hay reseñas aún.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection