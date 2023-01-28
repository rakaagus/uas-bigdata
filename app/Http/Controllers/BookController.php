<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Resources\BookResource;
use App\Models\Book;
use File;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $book = Book::all();
        $data = BookResource::collection($book);
        if(count($book) === 0){
            return response()->json([
                "response_code" => "00",
                "response_message" => "Data Buku Masih Kosong",
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
            'title' => 'required|min:6',
            'pengarang' => 'required|min:6',
            'penerbit' => 'required|min:6',
            'tahun' => 'required|min:6|numeric',
            'jenis' => 'required',
            'bookshelves_id' => 'required',
            'sipnosis' => 'required',
            'isBooked' => 'required',
            'cover' => 'mimes:png,jpg,jpeg',
        ]);

        $buku = new Book;
        $buku->title = $request->title;
        $buku->pengarang = $request->pengarang;
        $buku->penerbit = $request->penerbit;
        $buku->tahun = $request->tahun;
        $buku->jenis = $request->jenis;
        $buku->bookshelves_id = $request->bookshelves_id;
        $buku->sipnosis = $request->sipnosis;
        $buku->isBooked = $request->isBooked;

        if($request->hasFile('cover')){
            $image = $request->file('cover');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = time().'.'.$image_extension;

            $image_path = '/photos/cover/';
            $image_location = $image_path.$image_name;

            try{
                $image->move(public_path($image_path), $image_name);
                $buku->image = $image_location;
            }catch(\Throwable $th){
                return response()->json([
                    "response_code" => "00",
                    "response_message" => "Cover Gagal diupload",
                ], 400);
            }
        }

        $buku->save();

        return response()->json([
            "response_code" => "00",
            "response_message" => "Tambah Buku berhasil",
        ], 201);
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
        $data = new BookResource(Book::find($id));
        // $data = Book::find($id);

        return response()->json([
            "response_code" => "00",
            "response_message" => "Detail Data Buku Berhasil Ditampilkan",
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
            'title' => 'required|min:6',
            'pengarang' => 'required|min:6',
            'penerbit' => 'required|min:6',
            'tahun' => 'required|min:6|numeric',
            'jenis' => 'required',
            'bookshelves_id' => 'required',
            'sipnosis' => 'required',
            'isBooked' => 'required',
            'cover' => 'mimes:png,jpg,jpeg',
        ]);

        $buku = Book::find($id);
        $buku->title = $request->title;
        $buku->pengarang = $request->pengarang;
        $buku->penerbit = $request->penerbit;
        $buku->tahun = $request->tahun;
        $buku->jenis = $request->jenis;
        $buku->bookshelves_id = $request->bookshelves_id;
        $buku->sipnosis = $request->sipnosis;
        $buku->isBooked = $request->isBooked;

        if($request->hasFile('cover')){
            $image = $request->file('cover');
            $image_extension = $image->getClientOriginalExtension();
            $image_name = time().'.'.$image_extension;

            $image_path = '/photos/cover/';
            $subBuku = substr($buku->image, 1);
            File::delete($subBuku);
            $image_location = $image_path.$image_name;

            try{
                $image->move(public_path($image_path), $image_name);
                $buku->image = $image_location;
            }catch(\Throwable $th){
                return response()->json([
                    "response_code" => "00",
                    "response_message" => "Cover Gagal diupload",
                ], 400);
            }
        }

        $buku->save();

        return response()->json([
            "response_code" => "00",
            "response_message" => "Update Buku berhasil",
        ], 201);
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
        $buku = Book::find($id);
        $subBuku = substr($buku->image, 1);
        File::delete($subBuku);
        $buku->delete();
        return response()->json([
            "response_code" => "00",
            "response_message" => "berhasil Menghapus Buku",
        ], 200);
    }

    public function getAllBookPagination(){
        $book = Book::paginate(10);

        $data['book'] = $book;

        return response()->json([
            "response_code" => "00",
            "response_message" => "Data Book pagination Berhasil Ditampilkan",
            "data" => $data
        ], 200);
    }
}
