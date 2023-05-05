<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReviewController extends Controller
{
    public function create($bookId)
{
    $response = Http::get('https://www.googleapis.com/books/v1/volumes/' . $bookId);
    $book = json_decode($response->body());
    
    return view('review-create', compact('book'));
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'book_id' => 'required|string',
        'body' => 'required|string',
    ]);

    $bookId = $validatedData['book_id'];
    $response = Http::get('https://www.googleapis.com/books/v1/volumes/' . $bookId);
    $book = json_decode($response->body());
 
    $review = new Review([
        'body' => $validatedData['body'],
    ]);

    $review->book_id = $book->id;
    $review->user_id = auth()->user()->id;
    $review->save();

    return redirect()->route('books.show', $bookId);
}
}

