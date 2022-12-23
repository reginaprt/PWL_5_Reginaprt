<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;;

class BookController extends Controller
{
    public function books()
    {
        try{
            $books = Bool::all();

            return response()->json([
                'message' => 'success',
                'books' => $books,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Request failed'
            ], 401);
        }
    }

    public function create(Request $req)
    {
        $validate = $req->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required',
            'tahun' => 'required',
            'penerbit' => 'required',
            'cover' => 'image|file|max:2048'
        ]);

        if ($req->hasFile('cover')){
            $extension = $req->file('cover')->extensiom();
            $filname = 'cover_buku_'.time().'.'.$extension;
            $req->file('cover')->storeAs(
                'public/cover_buku', $filname
            );

            $validate['cover'] = $filname;
        }

        Book::create($validate);

        return response()->json([
            'message' => 'buku berhasil ditambahkan',
            'book' => $validate
        ], 200);
    }

    public function update(Request $req, $id)
    {
        $validate = $req->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required',
            'tahun' => 'required',
            'penerbit' => 'required',
            'cover' => 'image|file|max:2048'
        ]);

        if ($req->hasFile('cover')){
            $extension = $req->file('cover')->extensiom();
            $filname = 'cover_buku_'.time().'.'.$extension;
            $req->file('cover')->storeAs(
                'public/cover_buku', $filname
            );

            $validate['cover'] = $filname;
        }

        $book = Book::find($id);
        Storage::delete('public/cover_buku/' .$book->cover);
        $book->update($validate);

        return response()->json([
            'message' => 'buku berhasil diubah',
            'book' => $book,
        ], 200);
    }

    public function delete($id)
    {
        $book = Book::find($id);
        Storage::delete('public/cover_buku' . $book->cover);
        $book->delete();
        return response()->json([
            'message' => 'Buku berhadil dihapus',
        ], 200);
    }
}
