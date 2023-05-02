<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    

    public function store(Request $request) {
        //Modificar el request para que no aparezca la pagina de error de laravel y si un mensaje
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validacion
        $this->validate($request, [
            'name' => 'required|min:5|max:20',
            'username' => 'required|unique:users|min:5|max:20',
            'email' => 'required|unique:users|max:60',
            'password' =>  'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'username'=> $request->username,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

        //Auntenticar usuario
        auth()->attempt([
            'email'=> $request->email,
            'password'=> $request->password
        ]);

        //Otra forma de autenticar
        //auth()->attempt([$request->only('email', 'password')]);

        //Redireccionar
        return redirect()->route('posts.index');
    }
}
