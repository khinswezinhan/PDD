<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::factory()->create([
            'name' => 'Khin Swe Zin Han',
            'email' => 'khinswezinhan@gmail.com',
            'password' => bcrypt('khin171892'),
            'role_id' => 1,
           
        ]);

         User::factory()->create([
            'name' => 'Khaing Thazin',
            'email' => 'khaingthazin@gmail.com',
            'password' => bcrypt('khaingthazin12345'),
            'role_id' => 1,
           
        ]);
    }
}
