<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'cover_image',
        'google_books_id',
    ];

    public function favorites(){

        return $this->hasMany(Favorite::class);
    }

    public function reviews(){

        return $this->hasMany(Review::class);
    }
}