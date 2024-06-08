<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Book;

class BookController extends Controller
{
    //Function to Display allbook
    public function allBook(){
        $book = Book::all();
        return response()->json($book, 200);
    }

    //Function to Display Specified Book
    public function showBook($id){
        $book = Book::find($id);
        return response()->json($book, 200);
    }

    //Function to the addbook
    public function addBook(Request $request){
        try{
            $request->validate([
                'release_year' => 'required|integer|between:1980,2024',
            ]);
            $book = Book::create($request->all());

            return response()->json($book, 201);
        } catch(ValidationException $e){
            return response()->json(['error'=>$e->errors()], 422);
        }
    }

    //Function to the updateBook
    public function updateBook(Request $request, $id){
        $book = Book::find($id);
        $book->update($request->all());
        return response()->json($book, 200);
    }

    //Function to the deleteBook
    public function deleteBook($id){
        $book = Book::find($id);
        $book->delete();
        return response()->json(['message' => 'Buku berhasil dihapus'], 200);
    }
}
