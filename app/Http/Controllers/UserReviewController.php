<?php

namespace App\Http\Controllers;

use App\Models\Review;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserReviewController extends Controller
{

    public function index(){
        
        $bookIds = Review::pluck('book_id')->toArray();
        $books = $this->getBooks($bookIds);
        $reviews = $this->getReviews($books);

        return view('user-review', compact('books', 'reviews'));
    }

    public function getBooks($bookIds) {
        $client = new Client();
        $books = [];
        foreach ($bookIds as $id) {
            $response = $client->get('https://www.googleapis.com/books/v1/volumes/' . $id, [
                'query' => [
                    'key' => 'AIzaSyAeOxxD7y-PW0paFmKIRCtNcTTjLfBLCPI',
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
    public function getReviews($books){
        $bookIds = collect($books)->pluck('id');
        $userId = auth()->id();
        $reviews = Review::with('user', 'book')
            ->where('user_id', $userId)
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
