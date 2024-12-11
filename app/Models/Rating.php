<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['author_id', 'book_id', 'rating', 'user_id'];

    public function books() {
        return $this->belongsTo(Book::class);
    }
}