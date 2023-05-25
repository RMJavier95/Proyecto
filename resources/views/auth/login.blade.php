@extends('layouts.app')

@section('titulo')
    Iniciar Sesión en Biblioteca
@endsection

@section('contenido')
    <div class = "md:flex">
        <div class="md:w-1/3">
        </div>
        <div class="md:w-1/3 bg-gray-300 p-6 rounded-lg">
            <form method="POST" action="{{ route('login') }}"  novalidate>
                @csrf

                @if (session('mensaje'))
                    <p class="bg-gray-100 text-red-600 my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
                @endif
                
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
                    <input type="checkbox" id="remember" name="remember"> <label for="remember" class="mb-2 text-gray-500" > Mantener la sesión iniciada. </label>
                </div>
                
                <div class="mb-5">
                    <input type="submit" value="Iniciar Sesión" class="bg-gray-900 hover:bg-gray-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </div>
                
            </form>

        </div>

    </div>
@endsection