<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Rating;
use App\Models\User; 
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $ratings = [];

        $bookIds = Book::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        $chunkSize = 500;
        for ($i = 0; $i < 500000; $i++) {
            $bookId = $faker->randomElement($bookIds);
            $userId = $faker->randomElement($userIds);
            $rating = $faker->numberBetween(1, 10);

            
            $ratings[] = [
                'book_id' => $bookId,
                'user_id' => $userId,
                'rating' => $rating,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($ratings) >= $chunkSize) {
                Rating::insert($ratings);
                $ratings = [];
            }
        }

        if (count($ratings) > 0) {
            Rating::insert($ratings);
        }

        foreach ($bookIds as $bookId) {
            $this->updateBookRatings($bookId);
        }
    }

    /**
     * Update the voter count and average rating for a specific book.
     *
     * @param int $bookId
     * @return void
     */
    
     private function updateBookRatings(int $bookId): void
{
    // Hitung jumlah pengguna unik yang memberikan rating
    $voter = Rating::where('book_id', $bookId)->select('user_id')->distinct()->count();

    // Hitung rata-rata rating
    $averageRating = Rating::where('book_id', $bookId)->avg('rating') ?? 0;

    // Perbarui tabel books dengan voter dan average_rating
    Book::where('id', $bookId)->update([
        'voter' => $voter,
        'average_rating' => $averageRating,
    ]);
}
}