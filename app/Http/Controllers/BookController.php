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
                'key' => env('GOOGLE_BOOKS_API_KEY'),
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

}