<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth as AuthUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Events\UserRegisterEvent;
use App\Events\GenerateOtpUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Peminjaman;
use App\Models\OtpCode;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    //

    public function addRole(Request $req){
        $role = new Role;

        $role->name = $req->name;

        $role->save();

        return response()->json([
            'response_code' => '201',
            'response_message' => 'Berhasil Tambah Data',
            'data' => $role,
        ], 201);
    }

    public function getAllRole(){
        $role = Role::all();

        if(count($role) === 0){
            return response()->json([
                "response_code" => "200",
                "response_message" => "Data Role Belum Ada",
                "data" => null
            ], 200);
        }else{
            return response()->json([
                'response_code' => '201',
                'response_message' => 'Berhasil Tambah Data',
                'data' => $role,
            ], 201);
        }
    }

    public function getRole($id){
        $role = Role::find($id);

        return response()->json([
            'response_code' => '201',
            'response_message' => 'Berhasil Menampilkan Data Role',
            'data' => $role,
        ], 201);
    }

    public function register(Request $req){
        $validated = $req->validate([
            "name" => "required",
            "email" => "required|unique:users,email|email",
            "password" => "required|confirmed|min:8",
        ]);

        $user = User::create([
            'email' => $req['email'],
            'name' => $req['name'],
            'password' => Hash::make($req->password),
            'photo_profile' => null,
            'email_verified_at' => null,
        ]);

        $data['user'] = $user;

        $token = AuthUser::login($user);

        event(new UserRegisterEvent($user));

        return response()->json([
            "response_code" => "201",
            "response_message" => "user berhasil di register",
            'data' => $data,
            'token' => $token
        ], 201);
    }

    public function login(Request $req){
        $validated = $req->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['response_message' => 'Unauthorized'], 401);
        }

        return response()->json([
            "response_code" => "201",
            "response_message" => "user berhasil login",
            'token' => $token,
        ], 201);
    }

    public function profile(){
        $data['user'] = Auth()->user();
        $data['role'] = Auth()->user()->load('role');
        $data['peminjaman'] = Peminjaman::where('user_id', $data['user']->id)->get();

        if(count($data['peminjaman']) === 0){
            $data['peminjaman'] = null;
            return response()->json([
                "response_code" => "200",
                "response_message" => "Profile berhasil ditampilkan",
                "data" => $data
            ], 200);
        }

        return response()->json([
            "response_code" => "200",
            "response_message" => "Profile berhasil ditampilkan",
            "data" => $data
        ], 200);
    }

    public function logout(){
        auth()->logout();

        return response()->json([
            "message" => "Logout Berhasil",
        ]);
    }

    public function updatePassword(Request $req){

        $validated = $req->validate([
            "email" => "required",
            "password" => "required|confirmed|min:8",
        ]);

        $user = User::where('email', $req->email)->first();
        $user->password = Hash::make($req->password);
        $user->save();

        return response()->json([
            "response_code" => "201",
            "response_message" => "password berhasil di update",
        ], 201);
    }

    public function updateProfile(Request $request){
        $user = auth()->user();

        $validated = $request->validate([
            "name" => "required",
            "photo_profile" => "mimes:png,jpg,jpeg",
        ]);

        $user->name = $request->name;

        if($request->hasFile('photo_profile')){
            $photo = $request->file('photo_profile');
            $photo_extension = $photo->getClientOriginalExtension();
            $photo_name = Str::slug($user->name, '-').'-'.$user->id.'.'.$photo_extension;

            $photo_folder = '/photos/profile/';
            $photo_location = $photo_folder.$photo_name;

            try {
                $photo->move(public_path($photo_folder), $photo_name);
                $user->photo_profile = $photo_location;
            } catch (\Throwable $th) {
                return response()->json([
                    "response_code" => "00",
                    "response_message" => $th->getMessage(),
                ], 400);
            }
        }

        $user->save();

        return response()->json([
            "response_code" => "00",
            "response_message" => "Profile berhasil diupdate",
        ], 200);
    }

    public function generatorOTP(Request $request){
        $validated = $request->validate([
            "email" => "required|email",
        ]);

        $user = User::where('email', $request->email)->first();

        $user->generate_otp_code();

        $data['user'] = $user;

        //testing
        // Mail::to($user->email)->send(new GenerateOtp($user));
        event(new GenerateOtpUser($user));

        return response()->json([
            "success" => true,
            "message" =>  "OTP Code Berhasil di generate",
            "data" => $data,
        ], 200);
    }

    public function verifikasi(Request $request){
        $validated = $request->validate([
            "otp" => "required",
        ]);

        $otp_code = OtpCode::where('otp', $request->otp)->first();
        return response()->json([
                "response_code" => "01",
                "response_message" =>  "email sudah terverifikasi",
                "data" => $otp_code
        ], 200);
        if(!$otp_code){
            return response()->json([
                "response_code" => "01",
                "response_message" =>  "OTP Code tidak ditemukan"
            ], 400);
        }

        $now = Carbon::now();
        if($now > $otp_code->valid_until){
            return response()->json([
                "response_code" => "01",
                "response_message" =>  "otp code sudah tidak berlaku, silahkan generate ulang"
            ], 400);
        }

        //update user ketika otp yang dimasukan benar
        $user = User::find($otp_code->user_id);
        $user->email_verified_at = Carbon::now();
        $user->save();

        //delete otp
        $otp_code->delete();

        return response()->json([
            "response_code" => "01",
            "response_message" =>  "email sudah terverifikasi"
        ], 200);
    }
}
