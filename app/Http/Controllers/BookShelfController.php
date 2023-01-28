<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Bookshelf;

class BookShelfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Bookshelf::all();
        if(count($data) === 0){
            return response()->json([
                "response_code" => "00",
                "response_message" => "Data Rak Buku Masih Kosong",
                "data" => null,
            ]);
        }else{
            return response()->json([
                "response_code" => "00",
                "response_message" => "Data berhasil Ditampilkan",
                "data" => $data,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required|unique:booksleves,name|min:6',
        ]);

        $bookshelf = new Bookshelf;
        $bookshelf->name = $request->name;
        $bookshelf->save();

        return response()->json([
            "response_code" => "00",
            "response_message" => "Tambah Data Berhasil",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Bookshelf::find($id);
        return response()->json([
            "response_code" => "00",
            "response_message" => "Detail Data Campaign Berhasil Ditampilkan",
            "data" => $data
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'name' => 'required|unique:booksleves,name|min:6',
        ]);

        $bookshelf = Bookshelf::find($id);
        $bookshelf->name = $request->name;
        $bookshelf->save();

        return response()->json([
            "response_code" => "00",
            "response_message" => "Update Data Berhasil",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $bookshelf = Bookshelf::find($id);
        $bookshelf->delete();

        return response()->json([
            "response_code" => "00",
            "response_message" => "Hapus Data Berhasil",
        ]);
    }

    public function getAllBookshelf(){
        $bookshelf = Bookshelf::paginate(5);

        $data['bookshelf'] = $bookshelf;

        return response()->json([
            "response_code" => "00",
            "response_message" => "Data Bookshelf pagination Berhasil Ditampilkan",
            "data" => $data
        ], 200);
    }
}
