<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Peminjaman;
use App\Models\OtpCode;
use App\Models\Role;
use Carbon\Carbon;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'mongodb';
    protected $collection = 'users';

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'photo_profile',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function otpCode(){
        return $this->hasOne(OtpCode::class);
    }

    public function get_role_user(){
        $role = Role::where('name', 'user')->first();
        return $role->id;
    }

    public function isAdmin(){
        $role = Role::where('name', 'admin')->first();
        $idAdmin = $role->id;
        if($idAdmin){
            return true;
        }
    }

    public function generate_otp_code(){
        do{
            $randomNumber = mt_rand(100000, 999999);
            $check = OtpCode::where('otp', $randomNumber)->first();
        } while($check);

        $now = Carbon::now();

        $hari = date("Y-m-d H:i:s", strtotime("+4 minutes", strtotime($now)));

        $otp_code = OtpCode::updateOrCreate(
            ['user_id' => $this->id],
            ['otp' => $randomNumber, 'valid_until' => $hari]
        );
    }

    public static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->role_id = $model->get_role_user();
        });

        static::created(function($model){
            $model->generate_otp_code();
        });
    }

    public function peminjaman(){
        return $this->hasMany(Peminjaman::Class, 'user_id');
    }

}
