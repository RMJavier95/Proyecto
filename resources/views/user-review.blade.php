@extends('layouts.app')

@section('contenido')
    <div class="container mx-auto py-8">
            <h2 class="text-2xl font-bold mb-4">Reseñas de <span class="font-normal">{{ auth()->user()->username }}</span></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($reviews as $review)
                    <div class="mb-3">
                        <h5 class="card-title">{{ $review->book_name }}</h5>
                        
                        <p class="card-text">{{ $review->body }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $review->user->name}}</h6>

                        <form method="POST" action="{{ route('reviews.destroy', $review->id) }}">
                            @csrf
                            @method('DELETE')
                
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                            <a href="{{ route('reviews.edit', ['book_id' => $review->book_id, 'id' => $review->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>

                        </form>
                        
                      
                    </div>
                @empty
                    <p>No hay reseñas aún.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection