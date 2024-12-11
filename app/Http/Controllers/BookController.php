<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request) {
        $limit = $request->input('limit', 10);
        
        
        $search = $request->input('search');

        
        $books = Book::with('author')
            ->when($search, function($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhereHas('author', function($q) use ($search) {
                                 $q->where('name', 'like', "%{$search}%");
                             });
            })
            ->orderBy('average_rating', 'desc') 
            ->take($limit) 
            ->get();

        return view('books.index', compact('books', 'limit', 'search'));
    }
}