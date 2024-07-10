<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PagesSeeder extends Seeder
{
    public function run(): void{

        $pages =['Hakkımda', 'Kariyer'];
        foreach ($pages as $page) {
            DB::table('pages')->insert([
                'title' => $page,
                'slug' =>Str::slug($page),
                'image' => 'images/'.$page.'.png',
                'content' => Str::random(50),
                'order' => rand(1, 100),
                'created_at' => now(),
                'updated_at' => now()
            ]) ;
        }

    }
}
