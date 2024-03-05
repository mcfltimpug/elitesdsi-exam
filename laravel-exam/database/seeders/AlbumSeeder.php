<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DateTime;
use App\Models\Album;
use App\Models\Artist;

class AlbumSeeder extends Seeder
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

            $artist = Artist::where('name', $row[0])->first();

            $date = $row[3];
            $dateObject = DateTime::createFromFormat('ymd', trim($date));
            $year = $dateObject->format('Y');

            $createdAtObject = DateTime::createFromFormat('ymd', $date);
        
            $updatedAt = $row[4];
            $updatedAtObject = DateTime::createFromFormat('ymd', $updatedAt);
        
            Album::create([
                'name' => $row[1],
                'artist_id' => $artist->id,
                'year' => $year,
                'sales' => $row[2],
                'image' => $faker->imageUrl($width = 200, $height = 200),
                'created_at' => $createdAtObject->format('Y-m-d H:i:s'),
                'updated_at' => $updatedAtObject->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
