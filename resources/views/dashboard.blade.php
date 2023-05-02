@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex">
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/user.png') }}" alt="">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center py-10 md:items-start">
                <p class="text-gray-700 text-2xl mb-3">{{ $user->username }}</p>
                <p class="text-gray-700 text-sm mb-3 font-bold">
                    0
                    <span> Libros Favoritos </span>
                </p>
                <p class="text-gray-700 text-sm mb-3 font-bold">
                    0
                    <span> Reseñas </span>
                </p>
            </div>

        </div>
    </div>

@endsection