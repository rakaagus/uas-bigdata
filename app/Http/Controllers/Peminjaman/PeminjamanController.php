<?php

namespace App\Http\Controllers\Peminjaman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Book;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    //
    public function index(){
        $user = Auth()->user();
        $data = Peminjaman::where('user_id', $user->id)->get();
        $role = Role::find($user->role_id);

        if($role->name == "admin" || $role->name == "staff"){
            $dataAll = Peminjaman::all();
            return response()->json([
                "response_code" => "200",
                "response_message" => "Data Berhasil Ditampilkan",
                "data" => $dataAll
            ], 200);
        }else{
            if(count($data) === 0){
                return response()->json([
                    "response_code" => "200",
                    "response_message" => "Data Peminjaman Belum Ada",
                    "data" => null
                ], 200);
            }else{
                return response()->json([
                    "response_code" => "200",
                    "response_message" => "Data Berhasil Ditampilkan",
                    "data" => $data
                ], 200);
            }
        }
    }

    public function addPinjamanBuku(Request $req){

        $user = Auth()->user();

        $req->validate([
            'title' => 'required|min:6',
            'durasiHari' => 'required',
            'buku' => 'required',
        ]);

        $pinjaman = new Peminjaman;
        $pinjaman->title = $req->title;
        $pinjaman->status = "pending";
        $pinjaman->durasi_hari = $req->durasiHari;
        $pinjaman->user_id = $user->id;
        $pinjaman->buku = $req->buku;
        $pinjaman->jatuh_tempo = null;
        $pinjaman->tempo_pengambilan_buku = null;

        $pinjaman->save();

        return response()->json([
            "response_code" => "00",
            "response_message" => "Tambah Peminjaman berhasil",
        ], 201);
    }

    public function approvePeminjaman($id){

        $now = Carbon::now();

        $tempo = date("Y-m-d", strtotime("+1 days", strtotime($now)));

        $peminjaman = Peminjaman::find($id);
        $peminjaman->status = "approve";
        $peminjaman->tempo_pengambilan_buku = $tempo;

        $peminjaman->save();
        return response()->json([
            "response_code" => "00",
            "response_message" => "Approve Peminjaman Buku Berhasil",
        ], 201);
    }

    public function loadTempoPengambilan(){

        $now = Carbon::now();

        $date = date("Y-m-d", strtotime($now));

        $data = Peminjaman::where('tempo_pengambilan_buku', $date)->get();

        if(!count($data) == 0){
            $jatuhTempoPeminjaman = null;
            foreach($data as $x){
                $jatuhTempoPeminjaman = Peminjaman::find($x->id);
                $jatuhTempoPeminjaman->status = "cancle";
                $jatuhTempoPeminjaman->tempo_pengambilan_buku = null;
                $jatuhTempoPeminjaman->save();
            }

            return response()->json([
                "response_code" => "00",
                "response_message" => "Load Daftar Pinjaman Success",
                "data" => $jatuhTempoPeminjaman,
            ], 200);
        }else{
            return response()->json([
                "response_code" => "00",
                "response_message" => "Tidak Ada Daftar Jatuh Tempo",
            ], 200);
        }
    }

    public function berhasilPinjam($id){

        $now = Carbon::now();

        $hari = Peminjaman::find($id);

        $tempo = date("Y-m-d", strtotime("+{$hari->durasi_hari} days", strtotime($now)));

        $peminjaman = Peminjaman::find($id);
        $peminjaman->status = "approve";
        $peminjaman->status = $tempo_pengambilan_buku;
        $peminjaman->jatuh_tempo = $tempo;

        foreach( $peminjaman as $item ){
            $buku = Book::find($item);
            $buku->isBooked = true;
            $buku->save();
        }

        $peminjaman->save();
        return response()->json([
            "response_code" => "00",
            "response_message" => "Berhasil Meminjam Buku",
        ], 201);
    }
}
