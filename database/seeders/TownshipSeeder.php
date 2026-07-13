<?php

namespace Database\Seeders;

use App\Models\Township;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TownshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $townships = [
            ['name' => 'ပြည်မြို့', 'district_id' => 1],
            ['name' => 'ပေါင်းတည်မြို့', 'district_id' => 2],
            ['name' => 'နတ်တလင်းမြို့', 'district_id' => 3],
            ['name' => 'ပခုက္ကူမြို့', 'district_id' => 4],
            ['name' => 'ပဲခူးမြို့', 'district_id' => 5],

        ];

        Township::insert($townships);
    }
}
