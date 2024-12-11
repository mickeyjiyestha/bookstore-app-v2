<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $authors = [];

        $chunkSize = 500;
        for ($i = 0; $i < 1000; $i++) {
            $authors[] = [
                'name' => $faker->name(),
                'voter' => $faker->numberBetween(1,1000),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($authors) >= $chunkSize) {
                author::insert($authors);
                $authors = [];
            }
        }
        if (count($authors) > 0) {
            author::insert($authors);
        }
    }
}