<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Bookshelf;

class Book extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'books';
    protected $fillable = ['title', 'pengarang', 'penerbit', 'tahun', 'jenis', 'bookshelves_id', 'isBooked', 'cover'];

    public function bookshelf(){
        return $this->belongsTo(Bookshelf::class, 'bookshelves_id');
    }

    public static function rules() {
        return [
            'phone_restrictions' => [
                'array',
            ],
        ];
    }

}
