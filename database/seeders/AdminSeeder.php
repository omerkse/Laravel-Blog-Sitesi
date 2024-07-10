<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Ömer Köse',
            'email' => 'omerkose772@gmail.com',
            'password' => bcrypt('Omer.1453'),
            'remember_token' => Str::random(10), // random() fonksiyonu ile hatırlama simgesi oluştur
        ]);
    }
}
