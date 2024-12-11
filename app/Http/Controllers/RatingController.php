<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\author;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    public function index(Request $request)
    {
        // Ambil semua penulis
        $authors = Author::all();
    
        // Ambil buku berdasarkan author_id yang dipilih
        $books = [];
        if ($request->has('author_id')) {
            $books = Book::where('author_id', $request->author_id)->get();
        }
    
        return view('rating.index', compact('authors', 'books'));
    }
    

    // Menyimpan rating
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);
    
        // Simpan rating ke database dengan user_id default 1
        Rating::create([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);
    
        // Hitung average rating
        $this->updateAverageRating($request->book_id);
    
        // Redirect ke halaman daftar buku setelah berhasil
        return redirect()->route('books.index')->with('success', 'Rating submitted successfully!');
    }
    
    
    private function updateAverageRating($bookId)
    {
        // Ambil semua rating untuk buku tersebut
        $ratings = Rating::where('book_id', $bookId)->get();
    
        // Hitung total rating dan jumlah rating
        $totalRating = $ratings->sum('rating');
        $count = $ratings->count();
    
        // Hitung average rating
        $averageRating = $count > 0 ? $totalRating / $count : 0;
    
        // Update average rating dan voter di tabel books
        Book::where('id', $bookId)->update([
            'average_rating' => $averageRating,
            'voter' => $count // Update jumlah voter
        ]);
    }
}