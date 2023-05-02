@extends('layouts.app')

@section('titulo')
    Registrate en Biblioteca
@endsection

@section('contenido')
    <div class = "md:flex">
        <div class="md:w-1/3">
        </div>
        <div class="md:w-1/3 bg-gray-200 p-6 rounded-lg">
            <form action="{{route('register')}}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold" >Nombre</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Nombre"
                        class="border p-3 w-full rounded-lg @error('name') border-red-600 @enderror"
                        value="{{old('name')}}"
                    >
                    @error('name')
                        <p class="bg-gray-100 text-red-600 my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold" >Nombre Usuario</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Nombre Usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-600 @enderror"
                        value="{{old('username')}}"
                    >
                    @error('username')
                        <p class="bg-gray-100 text-red-600 my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold" >Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-600 @enderror"
                        value="{{old('email')}}"
                    >
                    @error('email')
                        <p class="bg-gray-100 text-red-600 my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold" >Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password"
                        class="border p-3 w-full rounded-lg @error('password') border-red-600 @enderror"
                    >
                    @error('password')
                        <p class="bg-gray-100 text-red-600 my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold" >Repetir Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Repite tu Password"
                        class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-600 @enderror"
                    >
                    @error('password_confirmation')
                        <p class="bg-gray-100 text-red-600 my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="submit" value="Registrar" class="bg-gray-900 hover:bg-gray-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </div>
                
            </form>

        </div>

    </div>
@endsection