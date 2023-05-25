@extends('layouts.app')

@section('contenido')
    <div class="container">
        <h2 class="text-2xl font-bold mb-4">Favoritos de <span class="font-normal">{{ auth()->user()->username }}</span></h2>
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $favorite)
                    <tr>
                        <td class="text-center">
                            <div class="w-3/3 pr-8">
                                <img class="rounded-lg shadow-md mb-4" src="{{ $favorite->volumeInfo->imageLinks->smallThumbnail }}" alt="{{ $favorite->volumeInfo->title }}">
                            </div>
                        </td>

                        <td class="text-center">{{ $favorite->volumeInfo->title }}</td>
                        <td class="text-center">
                            @if (isset($favorite->volumeInfo->authors))
                                <p class="text-lg font-bold mb-2"> {{ implode(', ', $favorite->volumeInfo->authors) }}</p>
                             @endif
                        </td>
                        <td class="text-center">
                            <form method="POST" action="{{ route('favorites.destroy', $favorite->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No tienes ningún libro en tus favoritos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection