<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;

class InfobookController extends Controller
{
    public function info(Request $request)
    {
        $query = $request->input('q'); // Obtén el término de búsqueda de la solicitud
        
        $client = new Client();
        $response = $client->request('GET', 'https://www.googleapis.com/books/v1/volumes', [
            'query' => [
                'q' => $query,
                'key' => 'AIzaSyAeOxxD7y-PW0paFmKIRCtNcTTjLfBLCPI',
            ]
        ]); // Hacer una solicitud a la API de Google Books con el término de búsqueda y la API Key

        $books = json_decode($response->getBody()->getContents()); // Decodifica la respuesta JSON
        
        return view('infobook', compact('books'));
        //return json_decode($response->getBody());
        //return new JsonResponse($response);
    }
}