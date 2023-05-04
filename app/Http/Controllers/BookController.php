<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use App\Models\Book;

class BookController extends Controller
{
    public function search(Request $request){

        $query = $request->input('q'); // Obtén el término de búsqueda de la solicitud
        
        $client = new Client();
        $response = $client->request('GET', 'https://www.googleapis.com/books/v1/volumes', [
            'query' => [
                'q' => $query,
                'key' => 'AIzaSyAeOxxD7y-PW0paFmKIRCtNcTTjLfBLCPI',
            ]
        ]); // Hacer una solicitud a la API de Google Books con el término de búsqueda y la API Key

        $books = json_decode($response->getBody()->getContents()); // Decodifica la respuesta JSON

        return view('book', compact('books'));
        //return json_decode($response->getBody());
        //return new JsonResponse($response);
    }

    public function show($id){

        $client = new Client();
        $response = $client->get("https://www.googleapis.com/books/v1/volumes/{$id}");
        $book = json_decode((string)$response->getBody());

        return view('infobook', compact('book'));
    }

    public function addToFavorites($id)
    {
        $book = Book::where('google_books_id', $id)->first();

        if (!$book) {
            // Si el libro no existe en la base de datos, primero lo buscamos en la API de Google Books
            $client = new Client();
            $response = $client->get("https://www.googleapis.com/books/v1/volumes/{$id}");
            $book_data = json_decode((string)$response->getBody(), true);

            // Creamos un nuevo libro en la base de datos con los datos obtenidos de la API
            $book = new Book();
            $book->google_books_id = $id;
            $book->title = $book_data['volumeInfo']['title'];
            $book->author = implode(", ", $book_data['volumeInfo']['authors'] ?? []);
            $book->description = $book_data['volumeInfo']['description'] ?? null;
            $book->cover_image = $book_data['volumeInfo']['imageLinks']['thumbnail'] ?? null;
            $book->save();
        }

        // Agregamos el libro a los favoritos del usuario autenticado
        auth()->user()->favorites()->create(['book_id' => $book->id]);

        return redirect()->back()->with('success', 'El libro ha sido agregado a tus favoritos');
    }

    public function indexFav()
    {
        $favorites = auth()->user()->favorites;
        return view('favorites', compact('favorites'));
    }


}