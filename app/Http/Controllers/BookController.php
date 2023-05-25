<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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

        $userHasReview = false;
        if (Auth::check()) {
            $review = Review::where('book_id', $id)
                ->where('user_id', Auth::id())
                ->first();
            $userHasReview = $review ? true : false;
        }

    return view('infobook', compact('book', 'userHasReview'));
    }

}