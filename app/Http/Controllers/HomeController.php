<?php

namespace App\Http\Controllers;

use App\Models\Review;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index()
    {
        $bookIds = Review::pluck('book_id')->toArray();
        $books = $this->getBooks($bookIds);
        $randomBooks = $this->getRandomBooks();
        $latestNews = $this->getLatestNews();
        $latestReviews = $this->getLatestReviews($books);

        return view('principal', compact('books', 'latestReviews', 'randomBooks','latestNews'));
    }

    private function getBooks($bookIds){

        return Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => 'id:' . implode(',', $bookIds),
            'key' => 'AIzaSyAeOxxD7y-PW0paFmKIRCtNcTTjLfBLCPI',
        ])->json()['items'];
        
    }

    private function getRandomBooks()
    {
        return Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => 'categories:all',
            'maxResults' => 4,
            'orderBy' => 'relevance',
            'langRestrict' => 'en',
            'key' => 'AIzaSyAeOxxD7y-PW0paFmKIRCtNcTTjLfBLCPI',
        ])->json()['items'];
    }

    private function getLatestNews()
    {
        return [
            [
                'title' => 'Nueva librería abre sus puertas en el centro de la ciudad',
                'description' => 'La nueva librería ofrece una amplia selección de libros de diferentes géneros.',
                'image' => 'https://via.placeholder.com/300x200',
                'date' => '2023-04-30'
            ],
            [
                'title' => 'Presentan nueva novela del autor X',
                'description' => 'La nueva novela del autor X promete ser un éxito de ventas.',
                'image' => 'https://via.placeholder.com/300x200',
                'date' => '2023-04-28'
            ],
            [
                'title' => 'Concurso de poesía en la biblioteca pública',
                'description' => 'La biblioteca pública organiza un concurso de poesía para fomentar la creatividad y el amor por la literatura.',
                'image' => 'https://via.placeholder.com/300x200',
                'date' => '2023-04-25'
            ]
        ];
    }

    private function getLatestReviews($books){
        
        $bookIds = collect($books)->pluck('id');
        $reviews = Review::with('user', 'book')
            ->whereIn('book_id', $bookIds)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        
        // Hacer una petición a la API de Google Books para obtener los detalles de cada libro
        $reviews->each(function ($review) {
            $book = Http::get('https://www.googleapis.com/books/v1/volumes/' . $review->book_id)
                ->json();

            $review->book_name = $book['volumeInfo']['title'];
        });
        
        return $reviews;
    }
}