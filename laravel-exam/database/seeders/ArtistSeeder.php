<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Artist;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $file = storage_path('app/album_sales.csv');
        $csvData = array_map('str_getcsv', file($file));

        $headerSkipped = false;

        foreach ($csvData as $row) {
            if (!$headerSkipped) {
                $headerSkipped = true;
                continue; 
            }

            $existingArtist = Artist::where('name', $row[0])->first();

            if (!$existingArtist){
                 Artist::create([
                    'name' => $row[0],
                    'code' => $faker->unique()->regexify('[A-Za-z0-9]{10}'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

           
        }

    }
}
