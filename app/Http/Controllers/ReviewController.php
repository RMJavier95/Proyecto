<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ReviewController extends Controller
{
    public function create($bookId){
        
        $response = Http::get('https://www.googleapis.com/books/v1/volumes/' . $bookId);
        $book = json_decode($response->body());
        
        return view('review-create', compact('book'));
    }

    public function edit($bookId){
        
        $response = Http::get('https://www.googleapis.com/books/v1/volumes/' . $bookId);
        $book = json_decode($response->body());
        
        return view('review-edit', compact('book'));
    }

    public function store(Request $request, $book_id){
        $validatedData = $this->validate($request, [
            'body' => 'required|string',
        ]);
    
        $response = Http::get('https://www.googleapis.com/books/v1/volumes/' . $book_id);
        $book = json_decode($response->body());
        
        if (!$book) {
            // Si no podemos obtener información sobre el libro, redirigimos al usuario a la página anterior
            return redirect()->back()->with('error', 'No se puede obtener información sobre el libro');
        }
    
        $review = new Review([
            'body' => $validatedData['body'],
        ]);
    
        $review->book_id = $book_id;
        $review->user_id = auth()->user()->id;
        $review->save();
    
        if (!$review) {
            // Si no se puede crear la revisión, redirigimos al usuario a la página anterior
            return redirect()->back()->with('error', 'No se puede guardar la revisión');
        }
    
        return redirect()->route('book.show', $book_id)->with('success', 'La revisión ha sido guardada');
    }

    /*public function edit(Review $review){

        // Verificar si el usuario autenticado es el dueño de la reseña
        if(auth()->id() !== $review->user_id) {
            abort(403, 'No tienes permiso para editar esta reseña.');
        }

        return view('edit-review', compact('review'));
    }*/

    public function update(Request $request, Review $review){

        $validatedData = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $review->update($validatedData);

        return redirect()->route('user-review.index')->with('success', 'Reseña actualizada correctamente.');
    }

    public function destroy(Review $review, $book_id){
        
        $review = Review::where('id', $book_id)->firstOrFail();
        $review->delete();
        return redirect()->route('user-review.index')->with('success', 'El libro ha sido eliminado de tus favoritos.');
    }
}

