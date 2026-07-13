<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            ['name' => 'ပြည်ခရိုင်', 'division_id' => 3],
            ['name' => 'သာယာဝတီခရိုင်', 'division_id' => 3],
            ['name' => 'နတ်တလင်းခရိုင်', 'division_id' => 3],
            ['name' => 'ပခုက္ကူခရိုင်', 'division_id' => 6],
            ['name' => 'ပဲခူးခရိုင်', 'division_id' => 3],

        ];

        District::insert($districts);
    }
}
