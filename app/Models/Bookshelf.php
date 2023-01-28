<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Book;

class Bookshelf extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'bookshelves';
    protected $fillable = ['name'];

    public function book(){
        return $this->hasMany(Book::class, 'bookshelf_id');
    }

}
