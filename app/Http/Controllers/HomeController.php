<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener API
        $randomBooks = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => 'subject:fiction',
            'maxResults' => 4,
            'orderBy' => 'relevance',
            'langRestrict' => 'en',
            'key' => 'AIzaSyAeOxxD7y-PW0paFmKIRCtNcTTjLfBLCPI',
        ])->json()['items'];

        // Obtener noticias (ejemplo)
        $latestNews = [
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

        // Obtener reseñas (ejemplo)
        $latestReviews = [
            [
                'title' => 'Excelente libro, muy recomendado',
                'description' => 'Me encantó este libro, tiene una trama muy interesante y los personajes son muy bien desarrollados.',
                'rating' => 4.5,
                'user' => 'Juan Perez'
            ],
            [
                'title' => 'No me gustó este libro',
                'description' => 'No logré conectarme con la historia y encontré algunos de los personajes un poco planos.',
                'rating' => 2,
                'user' => 'Maria Rodriguez'
            ],
            [
                'title' => 'Un libro entretenido',
                'description' => 'Este libro fue una buena lectura para pasar el tiempo, pero no creo que lo vuelva a leer.',
                'rating' => 3,
                'user' => 'Pedro Sanchez'
            ]
        ];

        return view('principal', compact('randomBooks', 'latestNews', 'latestReviews'));
    }
}