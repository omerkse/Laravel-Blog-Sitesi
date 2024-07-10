<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 4; $i++) {
            $title = $faker->sentence(6);
            DB::table('articles')->insert([
                'category_id' => rand(1, 4),
                'title' => $title,
                'image' => $faker->imageUrl(800, 400, 'cat'),
                'content' => $faker->paragraph(6),
                'slug' => Str::slug($title),
                'created_at' => $faker->dateTime( 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
