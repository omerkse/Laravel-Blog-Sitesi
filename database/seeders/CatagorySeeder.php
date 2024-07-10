<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catagories =['Eğlence', 'Bilişim ve Teknoloji', 'Spor', 'Günlük Yaşam'];
            foreach ($catagories as $catagory) {
                DB::table('categories')->insert([
                    'name' => $catagory,
                    'slug' =>Str::slug($catagory),
                    'created_at' => now(),
                    'updated_at' => now()
                ]) ;
            }

    }
}
