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

    
    private function getBooks($bookIds) {
        $client = new Client();
        $books = [];
        foreach ($bookIds as $id) {
            $response = $client->get('https://www.googleapis.com/books/v1/volumes/' . $id, [
                'query' => [
                    'key' => env('GOOGLE_BOOKS_API_KEY'),
                ],
            ]);

            $book = json_decode($response->getBody(), true);
            if(isset($book['error'])) {
                // manejar error en caso de que no exista el libro
                continue;
            }

            $books[] = $book;
        }

    return $books;
    }

    private function getRandomBooks()
    {
        return Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => 'categories:all',
            'maxResults' => 6,
            'orderBy' => 'relevance',
            'langRestrict' => 'en',
            'key' => env('GOOGLE_BOOKS_API_KEY'),
        ])->json()['items'];
    }

    private function getLatestNews()
    {
        return [
            [
                'title' => 'Haruki Murakami, Premio Princesa de Asturias de las Letras 2023',
                'description' => '',
                'image' => 'https://www.publico.es/files/article_main/uploads/2023/05/24/646de325aa9fa.jpeg',
                'date' => '2023-04-30',
                'link' => 'https://www.publico.es/culturas/haruki-murakami-premio-princesa-letras-2023.html#analytics-seccion:listado'
            ],
            [
                'title' => 'Brandon Sanderson desvela cuáles de sus novelas quiere ver adaptadas como series y películas',
                'description' => '',
                'image' => 'https://media.vandalsports.com/i/1706x960/5-2023/20235412330_1.jpg.webp',
                'date' => '2023-04-30',
                'link' => 'https://vandal.elespanol.com/noticia/r20552/brandon-sanderson-desvela-cuales-de-sus-novelas-quiere-ver-adaptadas-como-series-y-peliculas'
            ],
            [
                'title' => 'George R. R. Martin afirma que la huelga de guionistas no retrasará (más) Vientos de invierno',
                'description' => '',
                'image' => 'https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2023/05/george-rr-martin-3028106.jpg?tf=1200x',
                'date' => '2023-04-30',
                'link' => 'https://www.hobbyconsolas.com/noticias/george-r-r-martin-no-retrasara-vientos-invierno-huelga-guionistas-1248540'
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
    
        $reviews = $reviews->map(function ($review) use ($books) {
            $book = collect($books)->where('id', $review->book_id)->first();
            $review->book_name = $book ? $book['volumeInfo']['title'] : '';
    
            return $review;
        });
    
        return $reviews;
    }
}