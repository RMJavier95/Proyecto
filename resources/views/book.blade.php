@extends('layouts.app')

@section('contenido')
<div class="flex flex-wrap justify-center">
    @if(isset($books->items))
        @foreach($books->items as $book)
        @if (isset($book->volumeInfo->imageLinks))
        <div class="relative mx-4 my-8 max-w-sm">
            <div class="h-48 w-full object-cover rounded-lg overflow-hidden bg-red-400 cursor-pointer rounded-xl relative group">
                <a href="{{route('book.show', $book->id)}}">
                    <img class="h-48 w-full object-cover rounded-lg shadow-md group-hover:scale-110 transition duration-300 ease-in-out" src="{{ $book->volumeInfo->imageLinks->smallThumbnail }}">
                </a>
                <div class="rounded-xl z-50 opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out cursor-pointer absolute from-black/80 to-transparent bg-gradient-to-t inset-x-0 -bottom-2 pt-30 text-white flex items-end">
                    
                </div>
            </div>
        </div>
        @endif
        @endforeach 
    @endif
</div>
@endsection