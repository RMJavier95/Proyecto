<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Favorite;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;

class FavoriteController extends Controller
{
    public function store(Request $request, $id){

        $client = new \GuzzleHttp\Client();
        $response = $client->get("https://www.googleapis.com/books/v1/volumes/$id");
        $book = json_decode((string)$response->getBody(), true);

        $favorite = Favorite::create([
            'user_id' => auth()->id(),
            'book_id' => $book['id']
        ]);
        return redirect()->back()->with('success', 'Libro agregado a favoritos');
    }

    public function destroy($id){

        $favorite = Favorite::where('book_id', $id)->firstOrFail();
        $favorite->delete();
        return redirect()->route('favorites.index')->with('success', 'El libro ha sido eliminado de tus favoritos.');
    }

    public function index(){

        $favorites = auth()->user()->favorites;
        $books = [];
        foreach ($favorites as $favorite) {
            $client = new Client();
            $response = $client->get("https://www.googleapis.com/books/v1/volumes/{$favorite->book_id}");
            $book = json_decode((string)$response->getBody());
            $books[] = $book;
        }
        return view('favorites', compact('books'));
    }

    public function show($id){
        
        // Obtener el registro de favorito correspondiente al usuario actual y al libro seleccionado
        $favorite = Favorite::where('user_id', auth()->id())->findOrFail($id);

        // Obtener los detalles del libro desde la API de Google Books
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://www.googleapis.com/books/v1/volumes/'.$favorite->book_id);
        $book = json_decode($response->getBody());

        // Mostrar los detalles del libro en una vista
        return view('favorites.show', compact('book'));
    }
}
