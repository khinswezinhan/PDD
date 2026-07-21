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
            ['name' => 'မန္တလေးတိုင်းဒေသကြီး', 'photo' => 'images/divisions/မန္တလေးတိုင်းဒေသကြီး.jpg'],
            ['name' => 'ရန်ကုန်တိုင်းဒေသကြီး', 'photo' => 'images/divisions/ရန်ကုန်တိုင်းဒေသကြီး.jpg'],
            ['name' => 'ပဲခူးတိုင်းဒေသကြီး', 'photo' => 'images/divisions/ပဲခူးတိုင်းဒေသကြီး.jpg'],
            ['name' => 'ဧရာဝတီတိုင်းဒေသကြီး', 'photo' => 'images/divisions/ဧရာဝတီတိုင်းဒေသကြီး.jpg'],
            ['name' => 'စစ်ကိုင်းတိုင်းဒေသကြီး', 'photo' => 'images/divisions/စစ်ကိုင်းတိုင်းဒေသကြီး.jpg'],
            ['name' => 'မကွေးတိုင်းဒေသကြီး', 'photo' => 'images/divisions/မကွေးတိုင်းဒေသကြီး.jpg'],
            ['name' => 'တနင်္သာရီတိုင်းဒေသကြီး', 'photo' => 'images/divisions/တနင်္သာရီတိုင်းဒေသကြီး.jpg'],
            ['name' => 'ကချင်ပြည်နယ်', 'photo' => 'images/divisions/ကချင်ပြည်နယ်.jpg'],
            ['name' => 'ကယားပြည်နယ်', 'photo' => 'images/divisions/ကယားပြည်နယ်.jpg'],
            ['name' => 'ကရင်ပြည်နယ်', 'photo' => 'images/divisions/ကရင်ပြည်နယ်.jpg'],
            ['name' => 'ချင်းပြည်နယ်', 'photo' => 'images/divisions/ချင်းပြည်နယ်.jpg'],
            ['name' => 'မွန်ပြည်နယ်', 'photo' => 'images/divisions/မွန်ပြည်နယ်.jpg'],
            ['name' => 'ရခိုင်ပြည်နယ်', 'photo' => 'images/divisions/ရခိုင်ပြည်နယ်.jpg'],
            ['name' => 'ရှမ်းပြည်နယ်', 'photo' => 'images/divisions/ရှမ်းပြည်နယ်.jpg'],
            ['name' => 'နေပြည်တော်ကောင်စီနယ်မြေ', 'photo' => 'images/divisions/နေပြည်တော်ကောင်စီနယ်မြေ.jpg'],
        ];

        // Database ထဲသို့ တစ်ခုချင်းစီ ပတ်၍ ထည့်သွင်းခြင်း
        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}
