@extends('layouts.app')

@section('contenido')
    <div class="container">
        <h1>Mis Libros Favoritos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($favorites as $favorite)
                    <tr>
                        <td>{{ $favorite->book->title }}</td>
                        <td>{{ $favorite->book->author }}</td>
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