<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites;
        return view('favorites', compact('favorites'));
    }

    public function store(Book $book){

        dd($book['id']);
        $favorite = auth()->user()->favorites()->create(['book_id' => $book['google_books_id']]);

        return redirect()->back()->with('success', 'El libro ha sido agregado a tus favoritos');
    }   

 
    public function destroy($id)
    {
        //
    }
}
