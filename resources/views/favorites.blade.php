@extends('layouts.app')

@section('contenido')
    <div class="container">
        <h1>Mis Libros Favoritos</h1>
        <table class="table">
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
                        <td>
                            <div class="w-3/3 pr-8">
                                <img class="rounded-lg shadow-md mb-4" src="{{ $favorite->volumeInfo->imageLinks->smallThumbnail }}" alt="{{ $favorite->volumeInfo->title }}">
                            </div>
                        </td>

                        <td>{{ $favorite->volumeInfo->title }}</td>
                        <td>
                            @if (isset($favorite->volumeInfo->authors))
                                <p class="text-lg font-bold mb-2"> {{ implode(', ', $favorite->volumeInfo->authors) }}</p>
                             @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ route('favorites.destroy', $favorite->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
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