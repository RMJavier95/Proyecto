@extends('layouts.app')

@section('contenido')
<div class="container mx-auto">
    
        <h1 class="text-2xl font-bold mb-4">Reseña de "{{ $book->volumeInfo->title }}"</h1>
    

    <div class="flex flex-wrap justify-center items-start">
        <div class="w-1/3 pr-8">
            @if(isset($book->volumeInfo->imageLinks->thumbnail))
                <img class="rounded-lg shadow-md mb-4" src="{{ $book->volumeInfo->imageLinks->thumbnail }}" alt="{{ $book->volumeInfo->title }}">
            @endif
        </div>
        <div class="w-2/3">
            <form method="POST" action="{{ route('reviews.store', $book->id) }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="body">
                        Reseña
                    </label>
                    <textarea name="body" id="body" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="4"></textarea>
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Guardar reseña
                </button>
            </form>
            
            
        </div>
    </div>
</div>
@endsection