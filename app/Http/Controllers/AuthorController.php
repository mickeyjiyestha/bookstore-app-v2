<?php

namespace App\Http\Controllers;

use App\Models\author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        $authors = author::where('voter', '>', 5)
        ->orderBy('voter', 'desc')
        ->take(10)
        ->get();
        return view('authors.index', compact('authors'));
    }
}