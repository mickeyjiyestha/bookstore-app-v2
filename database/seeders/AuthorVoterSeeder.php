<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\Rating;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuthorVoterSeeder extends Seeder
{
/**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $this->updateAuthorVoterCounts();
    }

    /**
     * Update the voter count for each author based on the ratings of their books.
     *
     * @return void
     */ private function updateAuthorVoterCounts(): void
    {
        
        $authors = Author::all();
    
        foreach ($authors as $author) {
            
            $voterCount = Book::where('author_id', $author->id)->count(); 

            
            Author::where('id', $author->id)->update(['voter' => $voterCount]);
        }
    }
}