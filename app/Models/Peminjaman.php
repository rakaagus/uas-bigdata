<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\User;

class Peminjaman extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'peminjamen';
    protected $fillable = ['title', 'status', 'durasi_hari', 'user_id', 'jatuh_tempo', 'tempo_pengambilan_buku', 'buku'];

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }

}
