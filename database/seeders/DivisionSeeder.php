<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder; // 💡 သင်၏ Division Model ကို ခေါ်ယူရန်မမေ့ပါနှင့်

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // တိုင်းဒေသကြီးနှင့် ပြည်နယ်များစာရင်း Array
        $divisions = [
            ['name' => 'မန္တလေးတိုင်းဒေသကြီး'],
            ['name' => 'ရန်ကုန်တိုင်းဒေသကြီး'],
            ['name' => 'ပဲခူးတိုင်းဒေသကြီး'],
            ['name' => 'ဧရာဝတီတိုင်းဒေသကြီး'],
            ['name' => 'စစ်ကိုင်းတိုင်းဒေသကြီး'],
            ['name' => 'မကွေးတိုင်းဒေသကြီး'],
            ['name' => 'တနင်္သာရီတိုင်းဒေသကြီး'],
            ['name' => 'ကချင်ပြည်နယ်'],
            ['name' => 'ကယားပြည်နယ်'],
            ['name' => 'ကရင်ပြည်နယ်'],
            ['name' => 'ချင်းပြည်နယ်'],
            ['name' => 'မွန်ပြည်နယ်'],
            ['name' => 'ရခိုင်ပြည်နယ်'],
            ['name' => 'ရှမ်းပြည်နယ်'],
            ['name' => 'နေပြည်တော်ကောင်စီနယ်မြေ'],
        ];

        // Database ထဲသို့ တစ်ခုချင်းစီ ပတ်၍ ထည့်သွင်းခြင်း
        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}
