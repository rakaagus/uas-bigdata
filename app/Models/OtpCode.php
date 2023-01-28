<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\User;

class OtpCode extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'otp_codes';
    protected $fillable = ['otp','user_id','valid_until'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
