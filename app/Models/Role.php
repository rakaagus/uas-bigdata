<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Role;

class Role extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'roles';
    protected $fillable = ['name'];

    public function users(){
        return $this->hasMany(User::class, "role_id");
    }
}
